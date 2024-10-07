<template>
    <div class="home">
    <section class="hero">
      <div class="hero-content">
        <h2>清新飲品，隨時享受</h2>
        <p>立刻訂購，感受最純正的風味</p>
      </div>
    </section>
    <!-- 精選推薦區 -->
     <div class="text">精選推薦</div>
    <section class="recommended">
      <div class="beverage-grid" v-for="item in famousDrinks" :key="item.id">
        <div class="beverage-card">
          <img :src="item.image" :alt="item.name" />
          <h4>{{ item.name }}</h4>
          <p>{{ item.price }} 元</p>
          <button @click="addToCart(item)">加入購物車</button>
        </div>
      </div>
    </section>
  </div>
</template>
  
<script lang="ts" setup name="home">
  import {ref, onMounted} from 'vue';
  import axios from 'axios';
  import {useCountStore} from '@/store/count'

  const countstore = useCountStore();
  function addToCart(e:any){
    const add = ref({'name':e.name, 'price':e.price, 'image':e.image, 'quantity':e.quantity, 'classification':e.classification});
    // 直接執行 POST 請求
    return (async () => {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/addcart', add.value);
        //console.log(response.data);
        fetchCartItems();
      } catch (error) {
        console.error('Error while adding to cart:', error);
      }
    })(); // 立即調用 async 函式
  };
  //更新購物車商品數量
  const fetchCartItems = async() => {
  try{
    const response = await axios.get('http://127.0.0.1:8000/api/cart');
    //計算有多少商品
    countstore.count = response.data.length;
  }
  catch(error){
    console.error('cart error: ',error)
  }
};

  const famousDrinks = ref<Item[]>([]);
  interface Item {
    id: number;
    name: string;
    price: number;
    quantity:number;
    image:string;
  }
  const fetchFamousDrink = async () =>{
    try{
      const response = await axios.get('http://127.0.0.1:8000/api/products/home');// 發送 GET 請求到 Laravel API
      //console.log(response.data); // 確認返回的數據
      famousDrinks.value = response.data;// 將返回的商品資料儲存在 famousDrink 中
    }
    catch (error){
      console.error('Error fetching famousDrink:',error);
    }
  };
  onMounted(() =>{
    fetchFamousDrink();// 組件掛載時執行資料請求
  });
</script>

<style scoped>
  .hero {
    background-image: url('/tea.jpg');
    background-size: cover;
    background-position: center;
    padding: 60px 20px;
    text-align: center;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 400px;
  }

  .hero-content h2 {
    font-size: 3rem;
    margin: 0;
    padding: 0;
  }

  .hero-content p {
    font-size: 1.2rem;
    margin-top: 10px;
  }

  .category img {
    width: 100%;
    border-radius: 10px;
  }

  .recommended {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* 商品卡片的最小寬度 */
    gap: 40px;
  }
  .text{
    font-size:30px;
    padding:20px;
    display:flex;
    justify-content: center;
  }
  .beverage-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
  }
  .beverage-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
  }
  .beverage-card img {
    max-width: 400px; /* 限制 Logo 的寬度 */
    object-fit: cover; /* 確保圖片按比例填滿圓形 */
    width: 100%;
    height: 200px;
    object-fit: cover;
    margin-bottom: 10px;
  }
  .beverage-card button {
    background-color: #ff6600;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }
  .beverage-card button:hover {
    background-color: #cc5200;
  }
</style>