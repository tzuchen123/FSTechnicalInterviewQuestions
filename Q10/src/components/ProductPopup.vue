<template>
  <div class="popup" @click.self="$emit('close')">
    <div class="popup-content">
      <!-- 返回 & 關閉 -->
      <button v-if="mode === 'seenIn'" class="back" @click="$emit('back')">←</button>
      <button class="close" @click="$emit('close')">✕</button>

      <!-- 狀態一：商品詳情 -->
      <div v-if="mode === 'detail'">
        <h2 class="popup-title">Product Detail</h2>
        <div class="popup-image">
          <img :src="product.image" alt="商品大圖" />
          <button class="appear-btn" @click="$emit('switchMode', 'seenIn')">
            Seen In
          </button>
        </div>
        <p v-for="(line, idx) in product.description" :key="idx" class="popup-desc">
          {{ line }}
        </p>
      </div>

      <!-- 狀態二：商品出現的地方 -->
      <div v-else-if="mode === 'seenIn'" class="appearances">
        <h2 class="popup-title">Product - Seen In</h2>
        <img :src="product.image" alt="商品大圖" class="popup-top-img" />
        <div
          v-for="(place, index) in product.appearances"
          :key="index"
          class="appearance"
        >
          <img :src="place.mainImage" alt="地方主圖" class="place-main" />
          <div class="appearance-products">
            <img v-for="(p, i) in place.products" :key="i" :src="p.image" alt="子商品" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductPopup",
  props: {
    product: { type: Object, required: true },
    mode: { type: String, default: "detail" },
  },
};
</script>

<style scoped>
/* 背景 */
.popup {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
}

/* 內容 */
.popup-content {
  background: white;
  padding: 20px;
  border-radius: 8px;
  position: relative;
  width: 500px;
  max-height: 80vh;
  overflow-y: auto;
  text-align: center;
}

.popup-title {
  margin-bottom: 10px;
  font-size: 18px;
  font-weight: bold;
}

/* 返回 & 關閉 */
.back,
.close {
  position: absolute;
  top: 8px;
  background: transparent;
  border: none;
  font-size: 20px;
  cursor: pointer;
}
.back {
  left: 8px;
}
.close {
  right: 8px;
}

/* 商品詳情 */
.popup-image {
  position: relative;
  display: inline-block;
}
.popup-image img {
  width: 100%;
  border-radius: 6px;
}
.appear-btn {
  position: absolute;
  bottom: 10px;
  right: 10px;
  padding: 6px 12px;
  font-size: 13px;
  background: #000;
  color: #fff;
  border: 1px solid #000;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.2s ease;
}
.appear-btn:hover {
  background: #fff;
  color: #000;
}
.popup-desc {
  margin-top: 8px;
  font-size: 14px;
  line-height: 1.5;
}

/* 出現的地方 */
.popup-top-img {
  width: 100%;
  border-radius: 6px;
  margin-bottom: 15px;
}
.appearance {
  margin-bottom: 20px;
}
.place-main {
  width: 100%;
  border-radius: 6px;
}
.appearance-products {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
}
.appearance-products img {
  width: 32%;
  border-radius: 4px;
}
</style>
