import React, { useState, useEffect } from "react";
import AppCard from "../Components/ComponentDefault/App_Card";

export default function SearchPage({ result, apps }) {
    const [search, setSearch] = useState("");
    useEffect(() => {
        setSearch(result);
    });

    function findApp(search, apps) {
        const trimmedSearch = search.trim().toLowerCase();

        return apps.filter((app) => {
            const appNameLowerCase = app.name.toLowerCase();

            if (trimmedSearch === "") {
                return true;
            }

            return appNameLowerCase.includes(trimmedSearch);
        });
    }
    const filteredApps = findApp(search, apps);
    return (
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 mt-6 p-10 ">
            {filteredApps.length != 0 ? (
                filteredApps.map((app, index) => (
                    <AppCard
                        key={index}
                        slug={app.slug}
                        title={app.name}
                        description={app.description}
                        logo={app.logo}
                        reviews={app.nb_review}
                    />
                ))
            ) : (
                <div className="h-52 w-full flex justify-center ">
                    <div className="text-center ml-20 ">
                        <h2 className="font-semibold text-2xl">No results found</h2>
                        <p className="font-thin text-xl">
                            We can't find anything with that term at the moment,
                            try searching for something else.
                        </p>
                    </div>
                </div>
            )}
        </div>
    );
}
