import services from './translationServices';

export function whichProxyTranslation() {
  const hostname = document.location.hostname;

  // Google Translate
  if (
    hostname == 'translate.googleusercontent.com' ||
    hostname.startsWith('translate.google.')
  ) {
    return services.GOOGLE;
  }

  // Microsoft Bing Translate
  if ([
    'www.translatoruser-int.com',
    'www.translatetheweb.com',
    'ssl.microsofttranslator.com',
    'www.microsofttranslator.com',
  ].includes(hostname)) {
    return services.BING;
  }

  // Baidu Translate
  if ([
    'translate.baiducontent.com',
    'fanyi.baidu.com',
  ].includes(hostname)) {
    return services.BAIDU;
  }

  // Yandex Translate
  if (hostname == 'z5h64q92x9.net'
    || hostname.startsWith('translate.yandex.')
  ) {
    return services.YANDEX;
  }

  // Naver Papago
  if (hostname == 'papago.naver.net') {
    return services.NAVER;
  }

  return null;
}
