import 'bootstrap'
import './app.scss'

document.addEventListener('DOMContentLoaded', () => {
  ;(() => {
    const { hostname } = window.location

    if (
      hostname !== process.env.DOMAIN_NAME ||
      !hostname.endsWith(process.env.DOMAIN_NAME)
    ) {
      return
    }

    const _paq = (window._paq = window._paq || [])
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['setDocumentTitle', `${document.domain}/${document.title}`])
    _paq.push(['setCookieDomain', '*.sleekycode.com'])
    _paq.push(['setDomains', ['*.sleekycode.com']])
    _paq.push(['setDoNotTrack', true])
    _paq.push(['disableCookies'])
    _paq.push(['trackPageView'])
    _paq.push(['enableLinkTracking'])
    ;(function () {
      const u = 'https://matomo.sleekycode.com/'
      _paq.push(['setTrackerUrl', `${u}matomo.php`])
      _paq.push(['setSiteId', '1'])
      const d = document
      const g = d.createElement('script')
      const s = d.getElementsByTagName('script')[0]
      g.async = true
      g.src = `${u}matomo.js`
      s.parentNode.insertBefore(g, s)
    })()
  })()
})
