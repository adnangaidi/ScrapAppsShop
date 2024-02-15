import { useState } from 'react'
import { router } from '@inertiajs/react'
// import { useRoute } from '@/ziggy-js';
// import { Ziggy } from '../Dash/ziggy.js';
export default function AddApp({ setOpen }) {
  const [values, setValues] = useState({url:""})
  // const route=useRoute(Ziggy)

  function handleChange(e) {
    const value = e.target.value
    setValues(values => ({...values,[e.target.name]: value}))
    console.log(values)
  }

  function handleSubmit(e) {
    e.preventDefault();
    router.post('/addapp', values)
    setOpen(false);
      // .then(() => {
      //   // Handle success if needed
      //   setOpen(false);
      // })
      // .catch((error) => {
      //   // Handle error if needed
      //   console.error(error);
      // });
  }
  return (
    <>
      <div className="sm:w-auto sm:max-w-1/2">
        <div className="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
          <form className="space-y-6"  onSubmit={handleSubmit}>
          
            <div>
              <label htmlFor="url" className="block text-sm font-medium leading-6 text-gray-900">
                Url App with local en
              </label>
              <div className="mt-2">
                <input
                  id="url"
                  name="url"
                  type="url"
                  autoComplete="url"
                  required
                  onChange={handleChange} 
                  className="block w-auto rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
              </div>
            </div>
            <div className="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
              <button
                type="submit"
                className="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
              >
                Add app
              </button>
            </div>
          </form>
        </div>
      </div>
    </>
  );
}
