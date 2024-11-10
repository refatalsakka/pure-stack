import './services.scss'

document.addEventListener('DOMContentLoaded', () => {
  ;(() => {
    const servicesContainerElm = document.querySelector('.services-container')
    const curvedArrowElm = document.querySelector(
      '.home-services .curved-arrow'
    )

    curvedArrowElm.addEventListener('click', () => {
      servicesContainerElm.scrollIntoView({
        behavior: 'smooth'
      })
    })
  })()
  ;(() => {
    const coffeeBtnsElm = [
      ...document.querySelectorAll('.services-container .coffee-btn')
    ]
    const backElm = document.querySelector('.services-container .back')
    const servicesContainerElm = document.querySelector('.services-container')
    const sections = [
      ...servicesContainerElm.querySelectorAll(
        ':scope > div:not(:first-of-type)'
      )
    ]
    sections.forEach((section, i) => {
      section.addEventListener('click', () => {
        sections.slice(0, i + 1).forEach((activeSection) => {
          activeSection.classList.remove('animation')
          activeSection.nextElementSibling.classList.add('animation')
          setTimeout(() => {
            activeSection.classList.add('active')
          }, 0)
        })
      })
    })

    backElm.addEventListener('click', () => {
      const lastActiveSection = [
        ...servicesContainerElm.querySelectorAll(':scope > div.active')
      ].pop()

      if (lastActiveSection) {
        lastActiveSection.classList.remove('active')
        lastActiveSection.classList.add('animation')
        lastActiveSection.nextElementSibling.classList.remove('animation')
      }
    })

    coffeeBtnsElm.forEach((coffeeBtnElm, i) => {
      coffeeBtnElm.addEventListener('mouseover', () => {
        document
          .querySelector(`.services-container .coffee-bottom-right-${i + 1}`)
          .classList.add('active')
      })
      coffeeBtnElm.addEventListener('mouseleave', () => {
        document
          .querySelector(`.services-container .coffee-bottom-right-${i + 1}`)
          .classList.remove('active')
      })
    })
  })()
  ;(() => {
    const servicesContainerElm = document.querySelector('.services-container')
    const sections = [
      ...servicesContainerElm.querySelectorAll(
        ':scope > div:not(:first-of-type)'
      )
    ]

    let actionPerformed = false

    const observer = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting && !actionPerformed) {
            sections.reverse().forEach((section, i) => {
              setTimeout(() => {
                section.classList.remove('active')

                if (i === sections.length - 1) {
                  section.classList.add('animation')
                }
              }, i * 350)
            })

            actionPerformed = true
            observer.disconnect()
          }
        })
      },
      { threshold: 0.1 }
    )

    observer.observe(servicesContainerElm)
  })()
})
