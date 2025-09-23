<template>
  <div class="app">
    <!-- 主圖片 -->
    <div class="main-image">
      <img src="/main1.jpg" alt="Main" />
    </div>

    <!-- 三個商品圖片 -->
    <div class="products">
      <div
        v-for="product in products"
        :key="product.name"
        class="product"
        @click="openPopup(product)"
      >
        <img :src="product.image" :alt="product.name" />
      </div>
    </div>

    <!-- Pop-up -->
    <ProductPopup
      v-if="selectedProduct"
      :product="selectedProduct"
      :mode="popupMode"
      @close="closePopup"
      @back="popupMode = 'detail'"
      @switchMode="popupMode = $event"
    />
  </div>
</template>

<script>
import ProductPopup from "./components/ProductPopup.vue";

export default {
  components: { ProductPopup },
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
.main-image img {
  width: 100%;
  max-width: 600px;
}
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
</style>
