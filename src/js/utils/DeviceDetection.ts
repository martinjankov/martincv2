/**
 * Device Detection Utility
 * Provides reliable device type and capability detection using user agent and device features
 */

export enum DeviceType {
    MOBILE = 'mobile',
    TABLET = 'tablet',
    DESKTOP = 'desktop'
}

export interface DeviceInfo {
    type: DeviceType;
    isTouchDevice: boolean;
    isPortrait: boolean;
    screenWidth: number;
    screenHeight: number;
}

class DeviceDetector {
    private userAgent: string;
    private listeners: Array<(info: DeviceInfo) => void> = [];

    constructor() {
        this.userAgent = navigator.userAgent.toLowerCase();
        this.setupOrientationListener();
    }

    /**
     * Detects if device has touch capability
     */
    public isTouchDevice(): boolean {
        return (
            'ontouchstart' in window ||
            navigator.maxTouchPoints > 0 ||
            // @ts-ignore - for IE
            (window.navigator.msMaxTouchPoints !== undefined && window.navigator.msMaxTouchPoints > 0)
        );
    }

    /**
     * Detects device type based on user agent
     * More reliable than screen width alone
     */
    public getDeviceType(): DeviceType {
        // Mobile devices
        if (this.isMobileUserAgent()) {
            return DeviceType.MOBILE;
        }

        // Tablet devices
        if (this.isTabletUserAgent()) {
            return DeviceType.TABLET;
        }

        // Desktop
        return DeviceType.DESKTOP;
    }

    /**
     * Checks if user agent indicates a mobile device
     */
    private isMobileUserAgent(): boolean {
        return /android.+mobile|ip(hone|od)|bada|blackberry|iemobile|kindle|netfront|silk-accelerated|(hpw|web)os|fennec|minimo|opera m(ob|in)i|blazer|dolfin|dolphin|skyfire|zune/i.test(
            this.userAgent
        );
    }

    /**
     * Checks if user agent indicates a tablet device
     */
    private isTabletUserAgent(): boolean {
        return /ipad|android(?!.+mobile)|tablet|kindle|silk|playbook/i.test(this.userAgent);
    }

    /**
     * Check if device is in portrait orientation
     */
    public isPortrait(): boolean {
        if (window.matchMedia) {
            return window.matchMedia('(orientation: portrait)').matches;
        }
        return window.innerHeight > window.innerWidth;
    }

    /**
     * Get comprehensive device information
     */
    public getDeviceInfo(): DeviceInfo {
        return {
            type: this.getDeviceType(),
            isTouchDevice: this.isTouchDevice(),
            isPortrait: this.isPortrait(),
            screenWidth: window.innerWidth,
            screenHeight: window.innerHeight
        };
    }

    /**
     * Check if current device should use mobile UI
     * (mobile devices or tablets in portrait)
     */
    public shouldUseMobileUI(): boolean {
        const deviceType = this.getDeviceType();
        const isPortrait = this.isPortrait();

        return deviceType === DeviceType.MOBILE ||
               (deviceType === DeviceType.TABLET && isPortrait);
    }

    /**
     * Check if device is a mobile phone (regardless of orientation)
     * Use this for features that should always work on phones even in landscape
     */
    public isMobileDevice(): boolean {
        return this.getDeviceType() === DeviceType.MOBILE;
    }

    /**
     * Subscribe to device info changes (orientation, resize)
     */
    public subscribe(callback: (info: DeviceInfo) => void): () => void {
        this.listeners.push(callback);

        // Return unsubscribe function
        return () => {
            this.listeners = this.listeners.filter(listener => listener !== callback);
        };
    }

    /**
     * Setup listener for orientation and resize changes
     */
    private setupOrientationListener(): void {
        const handleChange = () => {
            const info = this.getDeviceInfo();
            this.listeners.forEach(callback => callback(info));
        };

        // Listen to orientation changes
        if (window.matchMedia) {
            window.matchMedia('(orientation: portrait)').addEventListener('change', handleChange);
        }

        // Listen to resize as fallback
        window.addEventListener('resize', handleChange);
    }

    /**
     * Helper: Should show touch-specific UI hints?
     * Returns true for all touch-capable devices regardless of screen size
     */
    public shouldShowTouchHints(): boolean {
        return this.isTouchDevice();
    }

    /**
     * Helper: Get appropriate zoom hint text
     */
    public getZoomHintText(): string {
        return this.isTouchDevice() ? 'Pinch to zoom' : 'Click image to zoom';
    }

    /**
     * Helper: Get appropriate video control hint text
     */
    public getVideoHintText(): string {
        return this.isTouchDevice() ? 'Tap video to pause/play' : 'Click video to pause/play';
    }
}

// Export singleton instance
export const deviceDetector = new DeviceDetector();

// Convenience exports
export const isTouchDevice = (): boolean => deviceDetector.isTouchDevice();
export const getDeviceType = (): DeviceType => deviceDetector.getDeviceType();
export const getDeviceInfo = (): DeviceInfo => deviceDetector.getDeviceInfo();
export const shouldUseMobileUI = (): boolean => deviceDetector.shouldUseMobileUI();
export const isMobileDevice = (): boolean => deviceDetector.isMobileDevice();
export const shouldShowTouchHints = (): boolean => deviceDetector.shouldShowTouchHints();
export const getZoomHintText = (): string => deviceDetector.getZoomHintText();
export const getVideoHintText = (): string => deviceDetector.getVideoHintText();
