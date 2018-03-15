export class Packages {
    public static TOPDITOPSTORE = 'TopDiTop Store';
    public static TOPSTORE = 'TopStore';
    public static STORE = 'Store';
    public static LIGHT = 'Light Store';

    public static paid() {
        return [this.STORE, this.TOPSTORE, this.TOPDITOPSTORE];
    }

    public static all() {
        return [this.LIGHT].concat(this.paid());
    }
}