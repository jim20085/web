<template>
  <!-- 商品展示區，按分類顯示對應產品 -->
  <div class="product-grid">
    <div class="category-section" v-for="category in categories" :key="category.id">
      <div class="text">{{ category.name }}</div>
      <div class="products">
        <div class="product-card" v-for="product in getProductsByClassification(category.classification)" :key="product.id">
          <img :src="product.image" alt="Product image" />
          <h3>{{ product.name }}</h3>
          <p>{{ product.price }} 元</p>
          <button @click="addToCart(product)">加入購物車</button>
        </div>
      </div>
    </div>
  </div>
    </template>
    
<script lang="ts" setup name="produce">
  import { ref, onMounted} from 'vue'
  import axios from 'axios';
  import {useCountStore} from '@/store/count'

  const countstore = useCountStore();

  interface Category {
    id: number;
    name: string;
    classification: string;
  }

  interface Product {
    id: number;
    name: string;
    price: number;
    image: string;
    classification: string;
  }
  const categories = ref<Category[]>([]);
  const products = ref<Product[]>([]);

  //API取得categories
  const fetchCategories = async () =>{
    try{
      const response = await axios.get('http://127.0.0.1:8000/api/categories');
      //console.log(response.data);
      categories.value = response.data;
    }
    catch(error){
      console.log('Error fetching categories:', error);
    }
  };

  //API取得product
  const fetchProducts = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/products'); // 發送 GET 請求到 Laravel API
      //console.log(response.data);  // 確認返回的數據
      products.value = response.data; // 將返回的商品資料儲存在 products 中
    } 
    catch (error) {
      console.error('Error fetching products:', error);
    }
  };

  onMounted(() => {
    fetchProducts(); // 組件掛載時執行資料請求
    fetchCategories(); // 組件掛載時執行資料請求
  });

  // 將商品按分類
  const getProductsByClassification = (classification:string) => {
    return products.value.filter(product => product.classification === classification);
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

  //新增購物車
  function addToCart(e:any){
    const add = ref({'name':e.name, 'price':e.price, 'image':e.image, 'quantity':e.quantity, 'classification':e.classification});
    //console.log('add',add.value)
    // 直接執行 POST 請求
    return (async () => {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/addcart', add.value);
        console.log(response.data);
        fetchCartItems();
      } catch (error) {
        console.error('Error while adding to cart:', error);
      }
    })(); // 立即調用 async 函式
  };

</script>
  
<style scoped>
  .text{
    font-size:32px;
  }
  .categories {
    padding: 20px;
  }

  .category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
  }

  .product-grid {
    padding: 20px;
  }

  .category-section {
    margin-bottom: 40px;

  }

  .products {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* 商品卡片的最小寬度 */
    gap: 40px;
  }

  .product-card {
    width: 100%; /* 保持卡片的寬度自適應 */
    height: 350px; /* 固定卡片的高度 */
    padding: 1rem;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* 卡片內部元素的排列 */
  }

  .product-card img {
    width: 100%;
    height: 200px; /* 固定圖片的高度 */
    object-fit: cover; /* 圖片保持比例並填滿卡片 */
    border-radius: 10px;
    margin-bottom: 1rem;
  }

  .product-card h3 {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
  }

  .product-card p {
    font-size: 1rem;
    margin-bottom: 1rem;
  }

  .product-card button {
    background-color: #42b983;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    cursor: pointer;
  }

  .product-card button:hover {
    background-color: #369870;
  }
</style>