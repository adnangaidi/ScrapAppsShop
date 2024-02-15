import React, { useState,useEffect } from 'react';
import 'boxicons';

export default function CarouselImg({media}) {
    const [currentIndex, setCurrentIndex] = useState(0);
    const [images,setImages]=useState([])
   
    const nextSlide = () => setCurrentIndex((prevIndex) => (prevIndex === images.length - 1 ? 0 : prevIndex + 1));
    const prevSlide = () => setCurrentIndex((prevIndex) => (prevIndex === 0 ? images.length - 1 : prevIndex - 1));

    return (
        <div className="overflow-hidden sticky ">
            <div className="flex transition-transform ease-out duration-300" style={{transform:`translateX(-${currentIndex * 100}%)`}}>
                {media.map((imag, index) => (
                    <img key={index} src={imag} alt="Slide" className="w-full h-full rounded-2xl" />
                ))}
            </div>
            <div className="absolute inset-0 flex items-center justify-between p-4">
                <button className="p-1 rounded-full shadow bg-white/80 text-gray-800 hover:bg-white" onClick={prevSlide}><box-icon name='chevron-left' type='solid' ></box-icon></button>
                <button className="p-1 rounded-full shadow bg-white/80 text-gray-800 hover:bg-white" onClick={nextSlide}><box-icon name='chevron-right' type='solid'></box-icon></button>
            </div>
        </div>
    );
}
