<template>
<div v-if="loading">Loading</div>
<div v-if="error">{{ error }}</div>
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 mb-3" v-for="article in news">
      <article-component :article="article"></article-component>
    </div>
  </div>
</template>

<script>

export default {
  name: "Main.vue",

  data() {
    return {
      news: [],
      loading: true,
      error: ''
    }
  },
  methods: {
    getNews: function(){

      axios.get('/api/search')
      .then(response=>{
        this.news = response.data
        this.loading = false;
      }).catch(error=>{
        this.loading = false;
        this.error = error.response.data;
      });
    }
  },
  mounted() {
    this.getNews();
  }

}
</script>

<style scoped>

</style>