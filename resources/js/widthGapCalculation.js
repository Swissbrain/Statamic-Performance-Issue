export default function calculateWidthGaps(maxColumns = 12, maxGap = 12, gapSize = 4) {
    let obj = {};
    for(let gap = 1; gap <= maxGap; gap++) {
        for(let columnSize = 1; columnSize <= maxColumns; columnSize++) {
            let gapSizeInPixel = gapSize * gap;

            for(let col = 1; col < columnSize; col++) {
                let columnDiff = columnSize - 1;
                let gapPixel = (gapSizeInPixel / col) * columnDiff / columnSize;

                obj[col + '/' + columnSize + '-gap-' + gap] = 'calc(100% / ' + columnSize + ' * ' + col + ' - ' + gapPixel + 'px)';
            }
        }
    }

    return obj;
};