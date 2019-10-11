<template>
<div>
  <div id='top-button' class="m-6 bg-deeppink flex fixed bottom-0 right-0 mb-16 mr-8">
    <transition name='fade'>
      <button v-if="show" @click="toTop" id='to-top' class='p-6 rounded-lg' :class='this.intersected ? "bg-white text-black" : "bg-black text-white"'>To Top</button>
    </transition>
  </div>
  <template v-for="slot in $slots">
    <slot /></template>
</div>
</template>

<script>
export default {
  props: {
    // px is where the to-top button should appear in pixels
    px: {
      default: 500,
      type: Number
    },
    // scrollTime is how long it should take to reach the top
    scrollTime: {
      default: -1,
      type: Number
    }
  },
  data: function() {
    return {
      show: false,
      scrolled: false,
      intersected: false
    }
  },
  methods: {
    toTop() {
      // scroll to top
      // if no prop is given, use default scrolling speed/effect
      if (this.scrollTime === -1) {
        window.scrollTo({
          top: 0,
          left: 0,
          behavior: 'smooth'
        })
      } else {
        // this function scrolls at a specified speed
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
          })
          if (currentTime < this.scrollTime) {
            setTimeout(animateScroll, increment);
          }
        }
        animateScroll();
      }
    },
    onScroll() {
      // this function is called when the window is scrolled
      // first it checks for intersections with any of the '.dark' & global-footer classes
      // this returns an array of intersections
      const intersectArr = [].map.call(document.querySelectorAll('.dark', '.global-footer'), (el) => {
        const button = document.getElementById('top-button').getBoundingClientRect()
        const rect = el.getBoundingClientRect()
        if (rect.top + rect.height >= button.top &&
          rect.left + rect.width >= button.left &&
          rect.bottom - rect.height <= button.bottom &&
          rect.right - rect.width <= button.right) {
          return true
        } else {return false}
      })
      // if any of the intersections are true then change the button display
      this.intersected = intersectArr.some((el) => el === true) ?  true : false
      // this detects scroll distance from the top to render the button conditionally
      this.scrolled = window.scrollY
      // this conditionally renders the button
      this.show = this.scrolled < this.px ? false : true
    }
  },
  created() {
    // sets event listeners
    window.addEventListener('scroll', this.onScroll);
  },
  destroyed() {
    // removes envent listners when component leaves
    window.removeEventListener('scroll', this.onScroll);
  }
}
</script>

<style scoped>
.light {
  @apply bg-white text-black;
}

.dark {
  @apply bg-black text-white;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity .5s;
}

.fade-enter,
.fade-leave-to
  {
  opacity: 0;
}
</style>
