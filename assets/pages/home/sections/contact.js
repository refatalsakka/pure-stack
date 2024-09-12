import './contact.scss'

document.addEventListener('DOMContentLoaded', () => {
  ;(() => {
    const form = document.querySelector('#contact form')
    const submitBtn = document.querySelector('#contact form button')
    const errorMessageElm = document.querySelector(
      '#contact form .error-message'
    )
    const successMessageElm = document.querySelector(
      '#contact form .success-message'
    )
    const contactInputNameElm = document.querySelector('#contactInputName')
    const contactInputEmailElm = document.querySelector('#contactInputEmail')
    const contactInputTelefonNumberElm = document.querySelector(
      '#contactInputTelefonNumber'
    )
    const contactInputRecaptchaTokenElm = document.querySelector(
      '#contactInputRecaptchaTokenElm'
    )
    const contactInputTermsReadElm = document.querySelector(
      '#contactInputTermsRead'
    )
    const contactInputYourMessageElm = document.querySelector(
      '#contactInputYourMessage'
    )
    const gRecaptchaElm = document.querySelector('#g-recaptcha')

    const validateEmail = (email) => {
      return String(email)
        .toLowerCase()
        .match(
          /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        )
    }

    function updateSubmitButtonState() {
      if (
        !contactInputNameElm.value ||
        !contactInputEmailElm.value ||
        !contactInputYourMessageElm.value ||
        !contactInputTermsReadElm.checked ||
        !validateEmail(contactInputEmailElm.value) ||
        !contactInputRecaptchaTokenElm.value
      ) {
        submitBtn.classList.add('disabled-btn')
      } else {
        submitBtn.classList.remove('disabled-btn')
      }
    }

    function clearInputs() {
      contactInputNameElm.value = ''
      contactInputEmailElm.value = ''
      contactInputYourMessageElm.value = ''
      contactInputTelefonNumberElm.value = ''
      contactInputRecaptchaTokenElm.value = ''
      contactInputTermsReadElm.checked = false
    }

    contactInputNameElm.addEventListener('input', updateSubmitButtonState)
    contactInputEmailElm.addEventListener('input', updateSubmitButtonState)
    contactInputYourMessageElm.addEventListener(
      'input',
      updateSubmitButtonState
    )
    contactInputTermsReadElm.addEventListener('input', updateSubmitButtonState)

    window.addEventListener('load', () => {
      const widgetId = grecaptcha.render('g-recaptcha', {
        sitekey: gRecaptchaElm.dataset.sitekey,
        callback: (token) => {
          contactInputRecaptchaTokenElm.value = token
          updateSubmitButtonState()
        }
      })

      form.addEventListener('submit', (e) => {
        e.preventDefault()

        const formData = new FormData(e.target)
        const submitBtnImgElm = submitBtn.querySelector('img')

        submitBtnImgElm.classList.add('spinning')
        form.classList.add('disable-section')
        submitBtnImgElm.classList.remove('spinning-out')

        fetch('/contact', {
          method: 'POST',
          body: formData
        }).then((response) => {
          setTimeout(() => {
            errorMessageElm.classList.remove('active')
            successMessageElm.classList.remove('active')
          }, 5000)

          if (!response.ok) {
            errorMessageElm.classList.add('active')
            successMessageElm.classList.remove('active')

            submitBtnImgElm.classList.remove('spinning')
            submitBtnImgElm.classList.add('spinning-out')
            submitBtn.classList.add('disabled-btn')
            form.classList.remove('disable-section')
            grecaptcha.reset(widgetId)

            return
          }

          errorMessageElm.classList.remove('active')
          successMessageElm.classList.add('active')

          submitBtnImgElm.classList.remove('spinning')
          submitBtnImgElm.classList.add('spinning-out')
          submitBtn.classList.add('disabled-btn')
          form.classList.remove('disable-section')
          grecaptcha.reset(widgetId)

          clearInputs()
        })
      })
    })
  })()
})
