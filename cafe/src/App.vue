<template>
  <div>
    <navBar/>
    <productComponent/>
  </div>
</template>
<script>

import navBar from "./components/dashborad/navBar.vue";
import productComponent from "./components/dashborad/productComponent";

export default {
  name: 'App',
  components: {
    navBar,
    productComponent
  }
}
</script>

