<template>
    <footer class="footer">
      <p>&copy; 2024 電商網站 | 聯繫我們</p>
      <P>本網站為私人練習用，圖片來源為AI生成</P>
      <div class="social-media">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </footer>
</template>

<script lang="ts" setup >
    //js or ts
    import {ref} from 'vue'
</script>

<style scoped>
.footer {
    padding: 1rem;
    background-color: #333;
    color: white;
    text-align: center;
}
.social-media a {
    margin: 0 10px;
    color: white;
    font-size: 1.5rem;
}
  </style>