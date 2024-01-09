import { useState } from "react";
import Header from "../Components/Shared/Header.jsx";
import Footer from "../Components/Shared/Footer.jsx";
import Main from "../Components/ComponentDefault/Main.jsx";
import Banner from "../Components/ComponentDefault/Banner.jsx";
import PropTypes from "prop-types";


function Welcome({ auth, apps,categories}) {
    return (
        <>
            <Header auth={auth}/>
            <Banner />
            <Main apps={apps} categories={categories} />
            <Footer />
        </>
    );
}
Welcome.propTypes = {
    auth: PropTypes.oneOfType([PropTypes.object, PropTypes.array]).isRequired,
    apps: PropTypes.oneOfType([PropTypes.object, PropTypes.array]).isRequired,
    categories: PropTypes.oneOfType([PropTypes.object, PropTypes.array]).isRequired,
};

export default Welcome;
