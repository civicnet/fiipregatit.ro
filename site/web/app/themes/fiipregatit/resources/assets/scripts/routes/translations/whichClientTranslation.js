import services from './translationServices';

export function whichClientTranslation() {
  if (document.querySelector('html.translated-ltr, head.translated-rtl')) {
    return services.GOOGLE;
  }

  if (document.querySelector('ya-tr-span')) {
    return services.YANDEX;
  }

  if (document.querySelector('*[_msttexthash]')) {
    return services.BING;
  }

  return null;
}
