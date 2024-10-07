<template>
    <header class="header">
      <!-- 左側：Logo -->
      <div class="logo">
        <img src="/logo.jpg" alt="Fresh Drinks Logo" />
      </div>

      <!-- 中間：導航欄 -->
      <nav class="nav">
        <router-link to="/" class="nav-link">首頁</router-link>
        <router-link to="/produce" class="nav-link">菜單</router-link>
        <router-link to="/about" class="nav-link">關於我們</router-link>
      </nav>

      <!-- 右側：購物車 -->
      <div class="cart">
        <router-link to="/cart" class="cart-link">
          <span>購物車 ({{ countstore.count }})</span>
        </router-link>
      </div>
    </header>

    <!-- 內容區域 -->
    <main class="content">
      <router-view></router-view>
    </main>

    <!-- 頁腳 -->
    <footer class="footer">
      <Foot/>
    </footer>
  </template>
  
<script lang="ts" setup name="home">
  import Foot from '@/components/foot.vue'
  import { onMounted } from 'vue'
  import axios from 'axios';
  import {useCountStore} from '@/store/count'

  const countstore = useCountStore();

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
  onMounted(() => {
    fetchCartItems()
  });
</script>

<style scoped>
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 20px;
    background-color: #ffcc00; /* 清新明亮的顏色，符合飲料店主題 */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .logo img {
    max-width: 100px; /* 限制 Logo 的寬度 */
    border-radius: 50%; /* 將圖片設為圓形 */
    object-fit: cover; /* 確保圖片按比例填滿圓形 */
    border: 5px solid white; /* 可選：添加白色邊框來增強效果 */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 可選：添加陰影效果 */
  }

  /* 導航欄 */
  .nav {
    display: flex;
    gap: 20px;
  }

  .nav-link {
    font-size: 1.1rem;
    color: #333;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
  }

  .nav-link:hover {
    color: #ff6600; /* 鼠標懸停時變成亮橘色 */
  }

  /* 購物車 */
  .cart {
    display: flex;
    align-items: center;
    gap:10px;
  }

  .cart-link {
    display: flex;
    align-items: center;
    color: #333;
    text-decoration: none;
    font-size: 1.1rem;
    transition: color 0.3s ease;
  }

  .cart-link img {
    width: 30px;
    margin-right: 10px;
  }

  .cart-link span {
    font-weight: bold;
  }

  .cart-link:hover {
    color: #ff6600;
  }
  .content {
    flex: 1; /* 內容區域撐開剩餘空間 */
    padding: 20px;
  }

  .footer {
    background-color: #333;
    color: white;
    padding: 20px;
    text-align: center;
  }
</style>