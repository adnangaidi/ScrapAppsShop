import React from "react";
import { Link } from "@inertiajs/react"; 


const AppCard = ({ slug,title, description,logo,reviews }) => {
  return (
    <div className="min-w-xs h-36 rounded  flex flex-col  hover:bg-gray-200 cursor-pointer py-6">
      <Link href={route("app.show",{slug:slug})} >
        <div className="flex">
          <img src={`/${logo}`} className="w-14 h-14 mx-3"/>
          <div className=" grid-cols-1  items-center justify-between text-base font-medium text-gray-900">
            <h3 className="font-bold">{title}</h3>
            <p>{reviews? reviews:'NO'} reviews</p>
          </div>
        </div>
        <p className="mt-2 ml-3 text-sm  text-gray-600 grid-cols-9">{description}</p>
      </Link>
    </div>
  );
};

export default AppCard;
