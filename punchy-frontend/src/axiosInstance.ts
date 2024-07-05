import axios from 'axios'

const axiosInstance = axios.create({
  // baseURL: '/api/',
  // baseURL: 'https://backend.punchy.jorendhaen.be',
  baseURL: import.meta.env.VITE_BACKEND_URL,
  withCredentials: true,
  withXSRFToken: true,
  headers: {
    accept: 'application/json',
    contentType: 'application/json'
  }
})

export default axiosInstance
