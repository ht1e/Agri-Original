import axios from 'axios';
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;


localStorage.clear();




// async function getData() {
//     const url = "http://127.0.0.1:5557/apiRecomend?id=1";
//     try {
//       const response = await fetch(url);
//       if (!response.ok) {
//         throw new Error(`Response status: ${response.status}`);
//       }
  
//       const json = await response.json();
//       console.log(json);
//     } catch (error) {
//       console.error(error.message);
//     }
// }


axios('http://127.0.0.1:5557/apiRecomend?id=1')
.then(response => console.log(response))
.catch(err => console.log(err))
