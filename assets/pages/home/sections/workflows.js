import './workflows.scss'

document.addEventListener('DOMContentLoaded', () => {
  ;(() => {
    const workflowsElm = document.querySelector('#workflows')
    const iconsElm = workflowsElm.querySelectorAll('.icon')
    let time

    function startInterval() {
      time = setInterval(() => {
        const iconElm = document.querySelector('#workflows .icon.active')
        let nextSiblingIcon = iconElm.nextElementSibling

        while (nextSiblingIcon && !nextSiblingIcon.classList.contains('icon')) {
          nextSiblingIcon = nextSiblingIcon.nextElementSibling
        }

        if (!nextSiblingIcon) {
          nextSiblingIcon = iconsElm[0]
        }

        const titleElm = document.querySelector(`#${iconElm.dataset.title}`)
        const textElm = document.querySelector(`#${iconElm.dataset.text}`)

        iconElm.classList.remove('active')
        titleElm.classList.remove('active')
        textElm.classList.remove('active')

        const nextSiblingTitleElm = document.querySelector(
          `#${nextSiblingIcon.dataset.title}`
        )
        const nextSiblingTextElm = document.querySelector(
          `#${nextSiblingIcon.dataset.text}`
        )

        nextSiblingIcon.classList.add('active')
        nextSiblingTitleElm.classList.add('active')
        nextSiblingTextElm.classList.add('active')
      }, 15000)
    }

    iconsElm.forEach((iconElm) => {
      iconElm.addEventListener('click', () => {
        clearInterval(time)

        startInterval()

        iconsElm.forEach((elm) => elm.classList.remove('active'))
        document
          .querySelectorAll('.title')
          .forEach((elm) => elm.classList.remove('active'))
        document
          .querySelectorAll('.text')
          .forEach((elm) => elm.classList.remove('active'))

        const titleElm = document.querySelector(`#${iconElm.dataset.title}`)
        const textElm = document.querySelector(`#${iconElm.dataset.text}`)

        iconElm.classList.add('active')
        titleElm.classList.add('active')
        textElm.classList.add('active')
      })
    })

    let actionPerformed = false

    const observer = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting && !actionPerformed) {
            workflowsElm.querySelector('.circle').classList.add('in-center')
            startInterval()

            actionPerformed = true
            observer.disconnect()
          }
        })
      },
      {
        threshold: 0.5
      }
    )

    observer.observe(workflowsElm)
  })()
})
