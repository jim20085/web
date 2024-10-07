<template>
<div class="cart">
    <h1>購物車</h1>
    <div class="cart-item" v-for="item in CartItem" :key="item.id">
      <h3>{{ item.name }}</h3>
      <p>{{ item.price }} 元</p>
      <input type="number" v-model.number="item.quantity" min="1" @input="updateQuantity(item)">
      <button @click="deleteitem(item)">刪除</button>
    </div>
    <h2>總價: {{ countstore.price }} 元</h2>
  </div>
  <div class="pay">
    <button @click="pay">結帳</button>
  </div>

</template>

<script lang="ts" setup name="cart">
import { ref, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';  // 使用 router 進行導航
import axios from 'axios';
import {useCountStore} from '@/store/count'

const countstore = useCountStore();
const router = useRouter();  // 使用 Vue router 進行導航
const CartItem = ref<Item[]>([]);

  interface Item {
    id: number;
    name: string;
    price: number;
    quantity:number;
  }

//計算總價
function totalprice(){
  let total = 0;
    for (const item of CartItem.value) {
      total += item.price * item.quantity;
    }
    countstore.price = total; 
}
//取得購物車
const fetchCartItems = async() => {
  try{
    const response = await axios.get('http://127.0.0.1:8000/api/cart');
   // console.log(response.data);
    CartItem.value = response.data;
    //計算總價
    totalprice();
    //計算有多少商品
    countstore.count = CartItem.value.length;
  }
  catch(error){
    console.error('cart error: ',error)
  }
};

onMounted(() => {
  fetchCartItems();
});

//更新購物車商品數量
function updateQuantity(item:any){
  const update = item.quantity;
  //console.log('updae: ',update,item.id)
  return (
    async() =>{
      try{
        const response = await axios.put(`http://127.0.0.1:8000/api/cart/${item.id}/update`,{quantity:update});
        //console.log('quantity update to: ', response.data)
        totalprice();
      }
      catch(error){
        console.error('update error: ',error)
      }
    }
  )();
}

//刪除購物車商品 
function deleteitem(item:any){
  const id = item.id;
  return(
    async() => {
      try{
        const response = await axios.delete(`http://127.0.0.1:8000/api/cart/${id}/delete`);
        //console.log('delete itemID',response.data)
        fetchCartItems();
      }
      catch(error){
        console.error('delete error',error)
      }
    }
  )();
}

//清空購物車
const clearcart = async() =>{
  try{
    const response = await axios.delete('http://127.0.0.1:8000/api/cart/deleteAll');
    fetchCartItems();
  }
  catch(error){
    console.error('clear error ', error)
  }
};

// 模擬結帳
const pay = () => {
  if (countstore.count === 0) {
    alert("購物車為空，無法結帳！");
    return;
  }

  // 模擬支付過程
  const confirmPayment = confirm('本次訂單總額為 '+ countstore.price +' 元 !');
  
  if (confirmPayment) {
    alert("支付成功！感謝您的購買！");
    clearcart();
    router.push('/');  // 結帳成功後導航回首頁
  }
};
</script>

<style scoped>
.cart-item {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr; /* 創建兩個等寬的列 */
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid #ddd;
}
.cart-item input {
  width: 50px;
  padding: 0.5rem;
}
.cart-item button {
  background-color: #ff4d4f;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 5px;
  cursor: pointer;
  width:20%;
}
.cart-item button:hover {
  background-color: #e04343;
}
.pay button{
  background-color: #ff4d4f;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 5px;
  cursor: pointer;
}
</style>