<div id="tx-wa-float-root">
    <style>
        #tx-wa-float-root {
            position: fixed;
            left: 22px;
            bottom: 22px;
            z-index: 999;
        }

        #tx-wa-float-root .tx-wa-btn {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #25d366;
            color: #fff;
            text-decoration: none;
            box-shadow: 0 12px 28px -8px rgba(37, 211, 102, 0.65);
            animation: tx-wa-pop-in 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        #tx-wa-float-root .tx-wa-btn:hover {
            color: #fff;
            transform: scale(1.12) rotate(-6deg);
            box-shadow: 0 16px 34px -8px rgba(37, 211, 102, 0.85);
        }

        #tx-wa-float-root .tx-wa-ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px solid #25d366;
            animation: tx-wa-pulse 2.4s ease-out infinite;
            pointer-events: none;
        }

        #tx-wa-float-root .tx-wa-ring.tx-wa-ring-2 {
            animation-delay: 0.8s;
        }

        #tx-wa-float-root .tx-wa-btn svg {
            position: relative;
            z-index: 1;
            animation: tx-wa-wiggle 3.5s ease-in-out infinite;
        }

        #tx-wa-float-root .tx-wa-tooltip {
            position: absolute;
            left: 68px;
            top: 50%;
            transform: translateY(-50%) translateX(-6px);
            background: #1f2a24;
            color: #fff;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Jost', 'Segoe UI', system-ui, -apple-system, sans-serif;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, transform 0.2s ease;
            pointer-events: none;
        }

        #tx-wa-float-root .tx-wa-tooltip::before {
            content: "";
            position: absolute;
            left: -5px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 5px 6px 5px 0;
            border-style: solid;
            border-color: transparent #1f2a24 transparent transparent;
        }

        #tx-wa-float-root .tx-wa-btn:hover + .tx-wa-tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateY(-50%) translateX(0);
        }

        @keyframes tx-wa-pulse {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }
            100% {
                transform: scale(1.9);
                opacity: 0;
            }
        }

        @keyframes tx-wa-pop-in {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes tx-wa-wiggle {
            0%, 92%, 100% {
                transform: rotate(0deg);
            }
            94% {
                transform: rotate(-14deg);
            }
            96% {
                transform: rotate(10deg);
            }
            98% {
                transform: rotate(-6deg);
            }
        }

        @media (max-width: 700px) {
            #tx-wa-float-root {
                left: 14px;
                bottom: 14px;
            }

            #tx-wa-float-root .tx-wa-btn {
                width: 50px;
                height: 50px;
            }

            #tx-wa-float-root .tx-wa-btn svg {
                width: 24px;
                height: 24px;
            }

            #tx-wa-float-root .tx-wa-tooltip {
                display: none;
            }
        }
    </style>

    <a
        href="https://wa.me/917200555565"
        target="_blank"
        rel="noopener"
        class="tx-wa-btn"
        aria-label="Chat with us on WhatsApp"
    >
        <span class="tx-wa-ring"></span>
        <span class="tx-wa-ring tx-wa-ring-2"></span>
        <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2c-5.5 0-9.96 4.46-9.96 9.96 0 1.76.46 3.48 1.34 5L2 22l5.2-1.36a9.94 9.94 0 0 0 4.84 1.23h.01c5.5 0 9.96-4.46 9.96-9.96 0-2.66-1.03-5.16-2.9-7.04A9.9 9.9 0 0 0 12.04 2Zm0 18.19h-.01a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.09.81.82-3.01-.2-.31a8.24 8.24 0 0 1-1.26-4.4c0-4.55 3.7-8.25 8.25-8.25 2.2 0 4.27.86 5.83 2.42a8.2 8.2 0 0 1 2.41 5.83c0 4.55-3.71 8.24-8.25 8.24Zm4.52-6.16c-.25-.12-1.46-.72-1.69-.8-.23-.08-.39-.12-.56.12-.16.25-.64.8-.78.96-.14.16-.29.18-.54.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.14-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.15.16-.25.24-.41.08-.16.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.48-.4-.42-.56-.42-.14-.01-.31-.01-.47-.01a.9.9 0 0 0-.66.31c-.23.25-.86.85-.86 2.06 0 1.22.89 2.4 1.01 2.56.12.16 1.75 2.67 4.24 3.74.59.26 1.06.41 1.42.52.6.19 1.14.16 1.57.1.48-.07 1.46-.6 1.67-1.17.21-.58.21-1.07.14-1.17-.06-.11-.22-.17-.47-.29Z"/></svg>
    </a>
    <span class="tx-wa-tooltip">Chat with us</span>
</div>
