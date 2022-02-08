<template>
  <div v-if="loading"></div>
  <div v-if="error">{{ error }}</div>
  <div v-if="news.length">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 mb-3"  v-for="article in news">
        <article-component :article="article"></article-component>
      </div>
    </div>
  </div>

  <div v-else> No articles found </div>

</template>

<script>
export default {
  name: "Category",
  data(){
    return {
      news: [],
      loading: true,
      error: ''
    }
  },
  methods:{
    getArticles(){
      axios.get('/api/search/',{params:{queryString:this.$route.params.category}})
          .then(response=>{
            this.news = response.data;
            this.loading = false;
          })
          .catch(error=>{
            this.loading = false;
            this.error = error.response.data;
          })
    }
  },
  mounted(){
    this.getArticles();
  },
  created() {
    this.$watch(
        () => this.$route.params,
        (toParams, previousParams) => {
          this.getArticles();
        }
    )
  },

}
</script>

<style scoped>

</style>