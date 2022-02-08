<template>

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
      <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link class="nav-link" aria-current="page" :to="{name:'home'}">Home</router-link>
            </li>
            <li class="nav-item" v-for="category in categories">
              <router-link :to="{name:'category',params:{category:category.slug}}" class="nav-link">{{ category.name}}</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{name:'section'}" class="nav-link">More</router-link>
            </li>


          </ul>
          <form class="d-flex" @submit.prevent="submit">
            <input class="form-control me-2" type="search" placeholder="Search" v-model="searchQuery" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" >Search</button>
          </form>
        </div>
      </div>
    </nav>


</template>

<script>
export default {
  name: "Nav",
  data() {
    return {
      categories: [],
      searchQuery: ''
    }
  },
  methods: {
    getCategories: function (){
      axios.get('/api/categories')
      .then(response=>{
        this.categories = response.data
      })
    },
    submit: function(e){

    if(this.searchQuery.length > 0){
      this.$router.push({name:'category',params:{category:this.searchQuery}});
    }

    }
  },
  mounted() {
    this.getCategories();
  }
}
</script>

<style scoped>

</style>