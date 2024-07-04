import axios from 'axios'

const axiosInstance = axios.create({
  baseURL: '/api/',
  withCredentials: true,
  withXSRFToken: true,
  headers: {
    accept: 'application/json',
    contentType: 'application/json'
  }
})

export default axiosInstance
