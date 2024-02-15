const Ziggy = {"url":"http:\/\/127.0.0.1:8000","port":8000,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"apps.show":{"uri":"\/","methods":["GET","HEAD"]},"app.show":{"uri":"{slug}","methods":["GET","HEAD"],"parameters":["slug"]},"category.show":{"uri":"categories\/{category}","methods":["GET","HEAD"],"parameters":["category"]},"subcategory.show":{"uri":"subcategories\/{subcategory}","methods":["GET","HEAD"],"parameters":["subcategory"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
