function EmitFile(fileName, content) {
    EmitFile.fileName = fileName;
    EmitFile.content = JSON.stringify(content);
}

EmitFile.prototype.apply = (compiler) => {
    compiler.plugin('emit', (compilation, callback) => {
        compilation.assets[EmitFile.fileName] = {
            source: () => EmitFile.content,
            size: () => EmitFile.content.length,
        };

        callback();
    });
};

module.exports = EmitFile;