import './index.css'

import axios from 'axios'
import { filter, isEmpty, lowerCase, random, reject, sortBy } from 'lodash-es'

window.axios = axios
window._ = { filter, reject, sortBy, isEmpty, lowerCase, random }
