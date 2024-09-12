import './projects.scss'
import '@splidejs/splide/css'
import Splide from '@splidejs/splide'
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll'

document.addEventListener('DOMContentLoaded', () => {
  ;(() => {
    new Splide('.splide', {
      perPage: 1,
      breakpoints: {
        640: {
          perPage: 1
        }
      },
      type: 'loop',
      autoScroll: {
        speed: 0.5,
        pauseOnHover: false,
        rewind: true
      },
      direction: 'ltr',
      width: '100vw',
      drag: 'free',
      autoWidth: true,
      arrows: false,
      gap: '40px',
      pagination: false
    }).mount({
      AutoScroll
    })
  })()
})
