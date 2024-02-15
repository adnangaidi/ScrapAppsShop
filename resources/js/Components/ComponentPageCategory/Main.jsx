import React from 'react'
import AppCard from '../ComponentDefault/App_Card'
import Pagination from "./Pagination";

export default function Main({appsCategories}) {
  return (
    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 mt-6 p-10 ">
      {
          appsCategories.length != 0 ? appsCategories.map((app,index)=>(
          <>
          <AppCard key={index} slug={app.slug} title={app.name} description={app.description} logo={app.logo} reviews={app.nb_review}  />
          
          </>
        )) :(
          <div>
            no result
          </div>
        )
      }
    </div>
  )
}
