import './workValue.scss'

document.addEventListener('DOMContentLoaded', () => {
  ;(() => {
    const valuesElm = document.querySelector('#values')
    const flipcardsElm = [...valuesElm.querySelectorAll('.flip-card')]

    let actionPerformed = false

    const observer = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting && !actionPerformed) {
            flipcardsElm.forEach((card, i) => {
              setTimeout(() => {
                card.classList.remove('active')
              }, i * 100)
            })

            actionPerformed = true
            observer.disconnect()
          }
        })
      },
      {
        threshold: window.innerWidth <= 768 ? 0.2 : 0.5 // Adjust threshold based on screen size
      }
    )

    observer.observe(valuesElm)
  })()
})
