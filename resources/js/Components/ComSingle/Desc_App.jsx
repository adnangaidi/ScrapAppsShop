import React from 'react';

export default function Desc_App({description,role}) {

  
  return (
    <div className="mx-4 md:mx-10 lg:mx-36 font-sans bg-white py-24 sm:py-10   ">
      <h1 className="text-center text-lg md:text-2xl lg:text-3xl font-bold my-10">
        {description.title}
      </h1>
      <p className="text-sm md:text-base my-5 text-gray-600">
        {description.body}
      </p>
      <div className="grid gap-4 text-gray-600">
       {
        role.map((plde)=>(
          <div className="inline-flex  items-start">
          <span className="w-5 h-5 mx-3 mt-1" aria-hidden="true">
            <img src="https://apps.shopify.com/cdn/shopifycloud/shopify_app_store/assets/app_details_page/feature-icon-fe27ae4d66955b281c7352164b6387a5ba7dd48a0b643b33f4655eb786cfa46f.svg" alt="icon"/>
          </span>
          <span>{plde}</span>
        </div>
        ))
         
       }
      </div>
    </div>
  );
}
