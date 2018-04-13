export const environment = {
  production: false,
  apiUrl: 'http://localhost:8000/api',
  homeUrl: 'http://localhost:8000',
  passwordStrength: '^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})',
  local: {
    authToken: 'authToken',
    currentUser: 'user',
    deviceId: 'device',
    impersonate: 'impersonate'
  }
};
