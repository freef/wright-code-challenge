<template>
  <transition name='fade'>
<div class="container d-flex fixed" v-if="show">
  <button @click="toTop"  class='button pink'>To Top</button>
</div>
</transition>
</template>

<script>
export default {
  data: function() {
    return {
      show: false,
      scrolled: false
    }
  },
  methods: {
    toTop() {
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth'
      })
    },
    onScroll() {
      this.scrolled = window.scrollY
      this.show = this.scrolled < 500 ? false : true
    },
  },
  created() {
    window.addEventListener('scroll', this.onScroll);
  },
  destroyed() {
    window.removeEventListener('scroll', this.onScroll);
  }
}

</script>
<style scoped>
.button {
  border-radius: 1rem;
  background-color: deeppink;
  border: 2px solid black;
  color: black;
  padding: 2rem;
}

.none{
  display:none;
}

.fixed{
  position: fixed;
  bottom: 100px;
}

.pink {
  background-color: deeppink;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
