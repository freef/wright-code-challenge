<template>
<div id='top-button' class="container d-flex fixed">
  <transition name='fade'>
    <button v-if="show" @click="toTop" id='to-top' class='button'>To Top</button>
  </transition>
</div>
</template>

<script>
export default {
  props: {
    px: {
      default: -1,
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
      observer: null,
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
      let distance = ((this.scrolled/this.scrollTime) * increment)

      const animateScroll =() => {
        console.log('distance ' + distance)
        console.log('start ' + start)
        currentTime += increment
        start = start - distance
        window.scrollTo({
          top: start,
          left: 0,
          // behavior: 'smooth'
        })
        if (currentTime < this.scrollTime) {
          console.log(currentTime)
          setTimeout(animateScroll, increment);
        }
      }
      animateScroll();
    }
    },
    onScroll() {
      this.scrolled = window.scrollY
      this.show = this.scrolled < this.px ? false : true
    },
  },
  created() {
    window.addEventListener('scroll', this.onScroll);
  },
  destroyed() {
    window.removeEventListener('scroll', this.onScroll);
  },
  mounted() {
    // console.log(this.$slots.default)
    // const config = {
    //   root: null, // sets the framing element to the viewport
    //   rootMargin: '0px',
    //   threshold: 0.5
    // }
    // const target = document.querySelectorAll('.dark')
    // this.observer = new IntersectionObserver(entries => {
    //   entries.forEach(entry => {
    //     if (entry.isIntersecting) {
    //       console.log('intersected')
    //     }
    //   })
    // })
    // this.observer.observe(target, config)
  }
}
</script>
<style>
:root {
  --light: 80;
  --threshold: 60;
}
</style>
<style scoped>
.button {
  border-radius: 1rem;
  --switch: calc((var(--light) - var(--threshold)) * -100%);
  background-color: hsl(0, 0%, var(--switch));
  border: 2px solid black;
  color: hsl(0, 0%, 0);
  padding: 2rem;
}

.none {
  display: none;
}

.fixed {
  position: fixed;
  bottom: 100px;
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
