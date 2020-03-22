const isDev = () => window.location.hostname === 'localhost'
  || window.location.hostname === 'fiipregatit.test';

export default isDev;
