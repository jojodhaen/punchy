import axios from 'axios'

const axiosInstance = axios.create({
  // baseURL: '/api/',
  baseURL: 'https://backend.punchy.jorendhaen.be',
  withCredentials: true,
  withXSRFToken: true,
  headers: {
    accept: 'application/json',
    contentType: 'application/json'
  }
})

export default axiosInstance
