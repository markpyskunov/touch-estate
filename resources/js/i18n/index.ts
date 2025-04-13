import { createI18n } from 'vue-i18n'

interface Messages {
  [key: string]: {
    message: {
      hello: string
    }
  }
}

const messages: Messages = {
  en: {
    message: {
      hello: 'Hello world',
    },
  },
  es: {
    message: {
      hello: 'Hola mundo',
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