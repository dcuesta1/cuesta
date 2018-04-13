export const environment = {
  production: true,
  apiUrl: './api',
  authToken: 'authToken',
  homeUrl: '../',
  passwordStrength: '^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})',
  local: {
    authToken: 'authToken',
    currentUser: 'user',
    deviceId: 'device',
    impersonate: 'impersonate'
  }
};
