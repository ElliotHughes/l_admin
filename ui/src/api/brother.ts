import axios from 'axios';


export function getBrotherList() {
  return axios.get('/v1/brother-list');
}
