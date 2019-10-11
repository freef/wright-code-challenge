<template>
<div>
  <div id='top-button' class="container d-flex fixed">
    <transition name='fade'>
      <button v-if="show" @click="toTop" id='to-top' class='button' :class='this.intersected ? "light-button" : "dark-button"'>To Top</button>
    </transition>
  </div>
  <template v-for="slot in $slots">
    <slot /></template>
</div>
</template>

<script>
export default {
  props: {
    px: {
      default: 500,
      type: Number
    },
    scrollTime: {
      default: 500,
      type: Number
    }
  },
  data: function() {
    return {
      show: false,
      scrolled: false,
      darkObserver: null,
      lightObserver: null,
      intersected: false
    }
  },
  methods: {
    toTop() {
      if (this.scrollTime === -1) {
        window.scrollTo({
          top: 0,
          left: 0,
          behavior: 'smooth'
        })
      } else {
        let start = this.scrolled
        let currentTime = 0
        let increment = 20
        let distance = ((this.scrolled / this.scrollTime) * increment)

        const animateScroll = () => {
          currentTime += increment
          start = start - distance
          window.scrollTo({
            top: start,
            left: 0,
            // behavior: 'smooth'
          })
          if (currentTime < this.scrollTime) {
            setTimeout(animateScroll, increment);
          }
        }
        animateScroll();
      }
    },
    onScroll() {
      const intersectArr = [].map.call(document.querySelectorAll('.dark'), (el) => {
        const button = document.getElementById('top-button').getBoundingClientRect()
        const rect = el.getBoundingClientRect()
        if (rect.top + rect.height >= button.top &&
          rect.left + rect.width >= button.left &&
          rect.bottom - rect.height <= button.bottom &&
          rect.right - rect.width <= button.right) {
          return true
        } else {return false}
      })
      this.intersected = intersectArr.some((el) => el === true) ?  true : false
      this.scrolled = window.scrollY
      this.show = this.scrolled < this.px ? false : true
    }
  },
  created() {
    window.addEventListener('scroll', this.onScroll);
  },
  destroyed() {
    window.removeEventListener('scroll', this.onScroll);
  }
}
</script>
<style>
</style>
<style scoped>
.button {
  padding: 1rem;
  border-radius: 1rem;
}

.light {
  background-color: white;
  color: black;
}

.dark {
  background-color: black;
  color: white;
}
.light-button {
  background-color: white;
  color: black;
}

.dark-button {
  background-color: black;
  color: white;
}

.none {
  display: none;
}

.fixed {
  position: fixed;
  bottom: 100px;
  right: 10%;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity .5s;
}

.fade-enter,
.fade-leave-to

/* .fade-leave-active below version 2.1.8 */
  {
  opacity: 0;
}
</style>
