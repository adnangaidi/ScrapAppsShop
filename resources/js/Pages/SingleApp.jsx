import { useState,useEffect } from "react";
import Header from "../Components/Shared/Header.jsx";
import Footer from "../Components/Shared/Footer.jsx";
import Container from "../Components/ComSinglePage/Container.jsx";
import SearchPage from "./SearchPage";

const SingleApp = ({ app,role, price, url,media }) => {
     useEffect(() => {
  console.log(app);
     }, [app])
     
    return (
        <>
            <Header  />
                <Container
                    app={app}
                    role={role}
                    price={price}
                    url={url}
                    media={media}
                />
            <Footer />
        </>
    );
};

export default SingleApp;
