import { createI18n } from 'vue-i18n'

const messages = {
  en: {
      locations: {
          features: {
              waterfront: 'waterfront',
              downtown: 'downtown',
              parking: 'parking',
              public_transit: 'public transit',
              walk_score: 'walk score',
              bike_score: 'bike score',
              transit_score: 'transit score',
          },
      },
  },
}

const i18n = createI18n({
  legacy: false,
  locale: 'en',
  fallbackLocale: 'en',
  messages,
})

export default i18n
