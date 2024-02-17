import React from 'react'
import AppCard from "./App_Card";

const SectionCategory = ({apps}) => {
  return (
    <div  className="grid grid-cols-1 sm:grid-cols-2  gap-8 mt-10 px-20 pb-20">
         {
          apps.map((app)=>(
            <AppCard key={app.id} id={app.app_id} slug={app.slug} title={app.name} description={app.description} logo={app.logo} reviews={app.nb_review}/>
          ))
         }
    </div>
  )
}

export default SectionCategory
