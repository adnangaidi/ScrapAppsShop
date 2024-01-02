import React, { useState } from 'react';
import { Carousel } from 'flowbite-react';

const Slidebar = () => {
    const apps = [
        {
          id: 1,
          name: "Postscript SMS Marketing",
          description:
            "Postscript is the go-to SMS marketing platform built specifically for Shopify stores. It enables brands to send hyper-personalized text messages to customers via campaigns, automations, and conversational responses. Open rates are 98%.",
          logo: "https://cdn.shopify.com/app-store/listing_images/54fb9eb4e59e94fa0e3b1b173de78ca4/icon/CNnjpLa0g_sCEAE=.png",
          url: "https://apps.shopify.com/postscript-sms-marketing?search_id=2db1bd18-b446-44b3-9789-01b6513c623f&surface_detail=postscript&surface_inter_position=1&surface_intra_position=4&surface_type=search",
        },
        {
          id: 2,
          name: "Geolocation ‑ Orbe",
          description:
            "Postscript is the go-to SMS marketing platform built specifically for Shopify stores. It enables brands to send hyper-personalized text messages to customers via campaigns, automations, and conversational responses. Open rates are 98%.",
          logo: "https://cdn.shopify.com/app-store/listing_images/300c7396da3de51b6c2a5df448979f2a/icon/CLzS5tCKkP8CEAE=.png",
          url: "",
        },
        {
          id: 3,
          name: "Loox Product Reviews & Photos",
          description:
            "Postscript is the go-to SMS marketing platform built specifically for Shopify stores. It enables brands to send hyper-personalized text messages to customers via campaigns, automations, and conversational responses. Open rates are 98%.",
          logo: "https://cdn.shopify.com/app-store/listing_images/252ae7c55fa0e8a35df7f6ff3c8c1596/icon/CPLp1Kb0lu8CEAE=.jpg",
          url: "",
        },
      ];
  return (
    <div className="mt-10 mx-3 h-56 sm:h-64 xl:h-80 2xl:h-96 bg-[#664CBC] rounded-md">
    <Carousel className='w-full mx-auto'>
      {
        apps.map((app)=>(
          <div key={app.id} className="w-3/4 my-28 md:my-8 py-8 flex flex-col md:flex-col">
            <div className='space-x-10 items-centre -mt-20 mb-5 ml-[300px] text-centre font-extrabold  text-4xl'><h2>Trending this January</h2></div>
            <div className=' flex md:flex-row items-center justify-between  '>
            <div className='flex md:flex-row space-x-1 ' ><img src={app.logo} alt='' className='md:w-1/4 md:h-1/5 rounded'/>
             <h2 className='text-5xl font-semibold mb-4 text-neutralDGey md:w-3/4 leading-snug'>{app.name}</h2> 
             </div>
             <div className='md:w-2/3 mx-10'>
             <p className='text-neutralDGey text-base mb-8'>{app.description}</p>
             </div>
            </div>
            
      </div>
        ))
      }
      
    </Carousel>
    </div>
  );
};

export default Slidebar;
