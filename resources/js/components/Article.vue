<template>
  <div class="card" >
    <div class="card-body">
      <router-link :to="{name:'article',params:{id:article.id.toString()}}">
        <h5 class="card-title" >
          {{ article.webTitle.substring(0,25) }}...
        </h5>
      </router-link>
      <h6 class="card-subtitle mb-2 text-muted">{{ article.sectionName }}, {{ article.pillarName }}</h6>
      <p class="card-text">{{ article.webTitle }}</p>
      <span class="card-link">{{ new Date(article.webPublicationDate).toLocaleDateString() }}</span>
      <a v-bind:href="article.webUrl" target="_blank" class="card-link">Read More</a>
    </div>
  </div>
</template>

<script>

export default {
  name: "Article",
  props:[
      'article'
  ],

}
</script>

<style scoped>

</style>