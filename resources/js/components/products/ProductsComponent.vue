<template>
  <section>
    <material-transition-group tag="div" class="row">
      <product-card-component :key="product.id" :data-index="index" v-bind:product="product" v-for="(product,index) in products"></product-card-component>
    </material-transition-group>
  </section>
</template>

<script>
export default {
  data() {
    return {
      name: "Products Component",
      products: [],
      endpoint: "/productos"
    };
  },
  created() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {
      axios.get(this.endpoint).then(response => {
        this.products = response.data.data;
      });
    }
  }
};
</script>