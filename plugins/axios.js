import axios from 'axios'
// let $baseURL = 'https://admin.fanarrealty.com';
let $baseURL = 'http://local.fanar.com';
export default axios.create({
  baseURL: $baseURL
});
export const siteURL = 'https://fanarrealty.com';