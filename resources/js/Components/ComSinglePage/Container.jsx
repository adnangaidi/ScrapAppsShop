import React,{useEffect} from "react";
import { Link } from "@inertiajs/react";
import App_info from "./App_info.jsx";
import Desc_App from "./Desc_App.jsx";
import Pricing from "./Pricing.jsx";
import PrimaryButton from "@/Components/shared/PrimaryButton";

export default function Container({app,role,price,url,media}) {
    return (
        <div className="bg-gray-50"> 
            <ul role="list"  >
                <li className="py-10 px-20 mx-auto">
                    <App_info app={app}  url={url}/>
                </li>
                <li className="py-4 mx-auto">
                    <Desc_App  title={app.title} body={app.body} role={role} media={media}/>
                </li>
                <li className="py-4 mx-auto">
                    {price && price.length != 0 ? <Pricing price={price} />: ''
                    }
                </li>
                <li >
                <div className="my-5">
                   <Link
                        className="mx-20 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150  "
                        href="/"
                    >
                        View All Apps
                    </Link>
                   </div>
                </li>
            </ul>
        </div>
    );
}
