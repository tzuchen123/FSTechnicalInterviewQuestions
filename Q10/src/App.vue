<template>
  <div class="app">
    <!-- 主圖片 -->
    <div class="main-image">
      <img src="/main1.jpg" alt="Main" />
    </div>

    <!-- 三個商品圖片 -->
    <div class="products">
      <div
        v-for="(product, index) in products"
        :key="index"
        class="product"
        @click="openPopup(product)"
      >
        <img :src="product.image" :alt="product.name" />
      </div>
    </div>

    <!-- Pop-up -->
    <div v-if="selectedProduct" class="popup">
      <div class="popup-content">
        <!-- 返回 & 關閉 -->
        <button v-if="popupMode === 'seenIn'" class="back" @click="popupMode = 'detail'">
          ←
        </button>
        <button class="close" @click="closePopup">✕</button>

        <!-- 狀態一：商品詳情 -->
        <div v-if="popupMode === 'detail'">
          <h2 class="popup-title">Product Detail</h2>
          <div class="popup-image">
            <img :src="selectedProduct.image" alt="商品大圖" />
            <!-- 查看出現的地方 -->
            <button class="appear-btn" @click="popupMode = 'seenIn'">Seen In</button>
          </div>
          <p
            v-for="(line, idx) in selectedProduct.description"
            :key="idx"
            class="popup-desc"
          >
            {{ line }}
          </p>
        </div>

        <!-- 狀態二：商品出現的地方 -->
        <div v-else-if="popupMode === 'seenIn'" class="appearances">
          <h2 class="popup-title">Product - Seen In</h2>
          <img :src="selectedProduct.image" alt="商品大圖" class="popup-top-img" />
          <div
            v-for="(place, index) in selectedProduct.appearances"
            :key="index"
            class="appearance"
          >
            <img :src="place.mainImage" alt="地方主圖" class="place-main" />
            <div class="appearance-products">
              <img
                v-for="(p, i) in place.products"
                :key="i"
                :src="p.image"
                alt="子商品"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [
        {
          name: "商品 A",
          image: "/p1.jpg",
          description: [
            "Product description line 1",
            "Product description line 2",
            "Product description line 3",
          ],
          appearances: [
            {
              mainImage: "/main2.jpg",
              products: [
                { image: "/p4.jpg" },
                { image: "/p1.jpg" },
                { image: "/p5.jpg" },
              ],
            },
            {
              mainImage: "/main3.jpg",
              products: [
                { image: "/p6.jpg" },
                { image: "/p7.jpg" },
                { image: "/p1.jpg" },
              ],
            },
          ],
        },
        {
          name: "商品 B",
          image: "/p2.jpg",
          description: [
            "Product description line 1",
            "Product description line 2",
            "Product description line 3",
          ],
          appearances: [
            {
              mainImage: "/main4.jpg",
              products: [
                { image: "/p2.jpg" },
                { image: "/p8.jpg" },
                { image: "/p9.jpg" },
              ],
            },
          ],
        },
        {
          name: "商品 C",
          image: "/p3.jpg",
          description: [
            "Product description line 1",
            "Product description line 2",
            "Product description line 3",
          ],
          appearances: [],
        },
      ],
      selectedProduct: null,
      popupMode: "detail", // "detail" | "seenIn"
    };
  },
  methods: {
    openPopup(product) {
      this.selectedProduct = product;
      this.popupMode = "detail";
    },
    closePopup() {
      this.selectedProduct = null;
      this.popupMode = "detail";
    },
  },
};
</script>

<style>
.app {
  text-align: center;
}

/* 主圖片 */
.main-image img {
  width: 100%;
  max-width: 600px;
}

/* 商品圖片 */
.products {
  display: flex;
  justify-content: center;
  width: 100%;
  max-width: 600px;
  margin: 20px auto 0;
}
.product {
  flex: 1;
  padding: 0 5px;
}
.product img {
  width: 100%;
  cursor: pointer;
  border-radius: 4px;
}

/* Pop-up 背景 */
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

/* Pop-up 內容 */
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
.back {
  position: absolute;
  top: 8px;
  left: 8px;
  background: transparent;
  border: none;
  font-size: 20px;
  cursor: pointer;
}
.close {
  position: absolute;
  top: 8px;
  right: 8px;
  background: transparent;
  border: none;
  font-size: 20px;
  cursor: pointer;
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
