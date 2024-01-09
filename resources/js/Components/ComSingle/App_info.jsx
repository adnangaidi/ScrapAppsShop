import React,{useEffect} from 'react';

export default function App_info({app,categorie,url}) {
 

  return (
    <div className="mx-4 md:mx-36 lg:mx-36 flex flex-col md:flex-row justify-between">
      <div className="mb-4 md:mb-0 inline-grid rounded-md shadow-sm">
        <div className="flex items-start">
          <div className="mr-4 flex-shrink-0">
            <img
              className="h-16 w-16 border border-gray-300 bg-white text-gray-300"
              src={app.logo}
              alt=""
            />
          </div>
          <div className="max-w-xs md:max-w-2xl">
            <h4 className="text-lg font-bold">{app.name}</h4>
            <p className="mt-1">{app.nb_review}  <span>reviews</span></p>
          </div>
        </div>
        <div>
          <ul className="flex justify-around mt-2">
            {categorie.map((cat) => (
              <li
                key={cat}
                className="mx-2 md:mx-4 px-2 md:px-4 py-1 cursor-pointer hover:bg-gray-300 h-8 md:h-10 w-auto self-center rounded-xl font-semibold text-sm md:text-base"
              >
                <a>{cat}</a>
              </li>
            ))}
          </ul>
        </div>
      </div>
      <div className="mt-4 md:mt-0 justify-self-end">
        <a
          type="button"
          href={url}
          className="rounded-full bg-[#8f54c2] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Install App
        </a>
      </div>
    </div>
  );
}