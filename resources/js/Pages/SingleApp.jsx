import { useState } from "react";
import Header from "../Components/Shared/Header.jsx";
import Footer from "../Components/Shared/Footer.jsx";
import Container from "../Components/ComSinglePage/Container.jsx";
import SearchPage from "./SearchPage";

const SingleApp = ({ apps,app, categorie, description, role, price, url,media }) => {
    const [searchResult, setSearchResult] = useState("");

    const handleSearchResult = (result) => {
        setSearchResult(result);
    }; 
    return (
        <>
            <Header onSearchResult={handleSearchResult} />
            {searchResult === "" ? (
                <>
                <Container
                    app={app}
                    categorie={categorie}
                    description={description}
                    role={role}
                    price={price}
                    url={url}
                    media={media}
                />
                </>
            ) : (
                <SearchPage result={searchResult} apps={apps} />
            )}
            <Footer />
        </>
    );
};

export default SingleApp;
