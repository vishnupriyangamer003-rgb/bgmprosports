<div id="tx-bulk-order-root" class="tx-bo">

    <style>
        #tx-bulk-order-root.tx-bo {
            --tx-primary: #795548;
            --tx-primary-dark: #5d4037;
            --tx-primary-light: #a1887f;
            --tx-primary-soft: #f4ece9;
            --tx-ink: #2b2320;
            --tx-muted: #8a7d78;
            --tx-border: #e8e0dc;
            --tx-bg: #faf7f5;
            --tx-danger: #d64545;
            --tx-success: #2e7d32;
            --tx-radius: 18px;
            font-family: 'Jost', 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--tx-ink);
            background: var(--tx-bg);
            padding: clamp(24px, 5vw, 56px) 16px;
        }

        #tx-bulk-order-root * {
            box-sizing: border-box;
        }

        #tx-bulk-order-root .tx-bo-wrap {
            max-width: 980px;
            margin: 0 auto;
        }

        #tx-bulk-order-root .tx-bo-head {
            text-align: center;
            margin-bottom: 32px;
        }

        #tx-bulk-order-root .tx-bo-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--tx-primary);
            background: var(--tx-primary-soft);
            padding: 6px 14px;
            border-radius: 999px;
            margin-bottom: 16px;
        }

        #tx-bulk-order-root .tx-bo-head h1 {
            font-size: clamp(26px, 3.6vw, 38px);
            font-weight: 600;
            margin: 0 0 10px;
            color: var(--tx-ink);
        }

        #tx-bulk-order-root .tx-bo-head p {
            color: var(--tx-muted);
            font-size: 15.5px;
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.6;
        }

        #tx-bulk-order-root .tx-bo-card {
            background: #fff;
            border: 1px solid var(--tx-border);
            border-radius: var(--tx-radius);
            box-shadow: 0 20px 50px -25px rgba(93, 64, 55, 0.25);
            overflow: hidden;
        }

        /* Steps */
        #tx-bulk-order-root .tx-bo-steps {
            display: flex;
            align-items: flex-start;
            padding: 26px clamp(16px, 4vw, 40px);
            background: linear-gradient(180deg, #fffdfc 0%, #fff 100%);
            border-bottom: 1px solid var(--tx-border);
        }

        #tx-bulk-order-root .tx-bo-step {
            flex: 1;
            position: relative;
            text-align: center;
        }

        #tx-bulk-order-root .tx-bo-step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 18px;
            left: calc(50% + 20px);
            right: calc(-50% + 20px);
            height: 2px;
            background: var(--tx-border);
            transition: background 0.25s ease;
        }

        #tx-bulk-order-root .tx-bo-step-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 2px solid var(--tx-border);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-size: 13px;
            font-weight: 700;
            color: var(--tx-muted);
            position: relative;
            z-index: 2;
            transition: all 0.25s ease;
        }

        #tx-bulk-order-root .tx-bo-step-title {
            font-size: 12.5px;
            color: var(--tx-muted);
            white-space: nowrap;
            font-weight: 500;
        }

        #tx-bulk-order-root .tx-bo-step.active .tx-bo-step-circle {
            background: var(--tx-primary);
            border-color: var(--tx-primary);
            color: #fff;
            box-shadow: 0 0 0 5px var(--tx-primary-soft);
        }

        #tx-bulk-order-root .tx-bo-step.active .tx-bo-step-title {
            color: var(--tx-primary-dark);
            font-weight: 700;
        }

        #tx-bulk-order-root .tx-bo-step.completed .tx-bo-step-circle {
            background: var(--tx-primary);
            border-color: var(--tx-primary);
            color: #fff;
        }

        #tx-bulk-order-root .tx-bo-step.completed .tx-bo-step-title {
            color: var(--tx-primary);
        }

        #tx-bulk-order-root .tx-bo-step.completed:not(:last-child)::after {
            background: var(--tx-primary);
        }

        /* Content */
        #tx-bulk-order-root .tx-bo-content {
            padding: clamp(22px, 4vw, 44px);
        }

        #tx-bulk-order-root .tx-bo-panel {
            display: none;
        }

        #tx-bulk-order-root .tx-bo-panel.active {
            display: block;
            animation: tx-bo-fade 0.35s ease;
        }

        @keyframes tx-bo-fade {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #tx-bulk-order-root .tx-bo-section-heading {
            margin-bottom: 26px;
        }

        #tx-bulk-order-root .tx-bo-section-heading h2 {
            font-size: 21px;
            font-weight: 600;
            margin: 0 0 6px;
        }

        #tx-bulk-order-root .tx-bo-section-heading p {
            color: var(--tx-muted);
            font-size: 13.5px;
            margin: 0;
        }

        #tx-bulk-order-root .tx-bo-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        #tx-bulk-order-root .tx-bo-group {
            display: flex;
            flex-direction: column;
        }

        #tx-bulk-order-root .tx-bo-group.full {
            grid-column: 1 / -1;
        }

        #tx-bulk-order-root .tx-bo-group label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--tx-ink);
        }

        #tx-bulk-order-root .tx-bo-required {
            color: var(--tx-danger);
        }

        #tx-bulk-order-root .tx-bo-optional {
            font-size: 11px;
            color: var(--tx-muted);
            font-weight: normal;
        }

        #tx-bulk-order-root .tx-bo-field-error {
            font-size: 12px;
            color: var(--tx-danger);
            margin-top: 6px;
            display: none;
        }

        #tx-bulk-order-root .tx-bo-group.has-error .tx-bo-field-error {
            display: block;
        }

        #tx-bulk-order-root .tx-bo-group.has-error input,
        #tx-bulk-order-root .tx-bo-group.has-error select,
        #tx-bulk-order-root .tx-bo-group.has-error textarea {
            border-color: var(--tx-danger) !important;
        }

        #tx-bulk-order-root .tx-bo-control {
            width: 100%;
            height: 48px;
            border: 1.5px solid var(--tx-border);
            border-radius: 10px;
            background: #fff;
            padding: 0 14px;
            font-size: 14px;
            font-family: inherit;
            color: var(--tx-ink);
            outline: none;
            transition: 0.2s ease;
        }

        #tx-bulk-order-root .tx-bo-control:focus {
            border-color: var(--tx-primary);
            box-shadow: 0 0 0 4px var(--tx-primary-soft);
        }

        #tx-bulk-order-root textarea.tx-bo-control {
            height: 110px;
            padding: 13px 14px;
            resize: vertical;
        }

        #tx-bulk-order-root select.tx-bo-control {
            cursor: pointer;
        }

        #tx-bulk-order-root .tx-bo-file-control {
            height: auto;
            padding: 10px 14px;
            line-height: 1.4;
        }

        #tx-bulk-order-root .tx-bo-hint {
            display: block;
            margin-top: 6px;
            font-size: 11.5px;
            color: var(--tx-muted);
        }

        #tx-bulk-order-root .tx-bo-phone {
            display: flex;
        }

        #tx-bulk-order-root .tx-bo-country-code {
            width: 62px;
            height: 48px;
            border: 1.5px solid var(--tx-border);
            border-right: 0;
            border-radius: 10px 0 0 10px;
            background: var(--tx-primary-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            color: var(--tx-primary-dark);
        }

        #tx-bulk-order-root .tx-bo-phone .tx-bo-control {
            border-radius: 0 10px 10px 0;
        }

        /* Products */
        #tx-bulk-order-root .tx-bo-product-header {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 44px;
            gap: 12px;
            padding: 0 2px 8px;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            color: var(--tx-muted);
        }

        #tx-bulk-order-root .tx-bo-product-row {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 44px;
            gap: 12px;
            margin-bottom: 12px;
            align-items: start;
        }

        #tx-bulk-order-root .tx-bo-product-row .tx-bo-control {
            height: 46px;
        }

        #tx-bulk-order-root .tx-bo-remove-product {
            width: 44px;
            height: 46px;
            border: 1.5px solid var(--tx-border);
            border-radius: 10px;
            background: #fff;
            cursor: pointer;
            color: var(--tx-muted);
            font-size: 18px;
            line-height: 1;
            transition: 0.2s ease;
        }

        #tx-bulk-order-root .tx-bo-remove-product:hover {
            color: #fff;
            background: var(--tx-danger);
            border-color: var(--tx-danger);
        }

        #tx-bulk-order-root .tx-bo-add-product {
            margin-top: 6px;
            border: 1.5px dashed var(--tx-primary-light);
            background: var(--tx-primary-soft);
            border-radius: 10px;
            height: 48px;
            width: 100%;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            color: var(--tx-primary-dark);
            transition: 0.2s ease;
        }

        #tx-bulk-order-root .tx-bo-add-product:hover {
            background: #ecdedb;
        }

        /* Preview */
        #tx-bulk-order-root .tx-bo-preview-section {
            border: 1px solid var(--tx-border);
            border-radius: 14px;
            margin-bottom: 16px;
            overflow: hidden;
        }

        #tx-bulk-order-root .tx-bo-preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 18px;
            background: var(--tx-bg);
            border-bottom: 1px solid var(--tx-border);
        }

        #tx-bulk-order-root .tx-bo-preview-header h3 {
            font-size: 14px;
            margin: 0;
            font-weight: 600;
        }

        #tx-bulk-order-root .tx-bo-edit-btn {
            border: 0;
            background: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            color: var(--tx-primary);
        }

        #tx-bulk-order-root .tx-bo-preview-body {
            padding: 18px;
        }

        #tx-bulk-order-root .tx-bo-preview-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px 30px;
        }

        #tx-bulk-order-root .tx-bo-preview-item small {
            display: block;
            color: var(--tx-muted);
            font-size: 11px;
            margin-bottom: 4px;
        }

        #tx-bulk-order-root .tx-bo-preview-item strong {
            font-size: 13.5px;
            font-weight: 500;
            word-break: break-word;
        }

        #tx-bulk-order-root .tx-bo-preview-table {
            width: 100%;
            border-collapse: collapse;
        }

        #tx-bulk-order-root .tx-bo-preview-table th,
        #tx-bulk-order-root .tx-bo-preview-table td {
            padding: 11px 8px;
            border-bottom: 1px solid var(--tx-border);
            text-align: left;
            font-size: 13px;
        }

        #tx-bulk-order-root .tx-bo-preview-table th {
            color: var(--tx-muted);
            font-weight: 600;
            font-size: 11.5px;
            text-transform: uppercase;
        }

        #tx-bulk-order-root .tx-bo-total-row {
            margin-top: 14px;
            display: flex;
            justify-content: flex-end;
            font-size: 14px;
            font-weight: 700;
            color: var(--tx-primary-dark);
        }

        /* Submit / success */
        #tx-bulk-order-root .tx-bo-submit-box {
            text-align: center;
            max-width: 560px;
            margin: 10px auto 0;
        }

        #tx-bulk-order-root .tx-bo-icon-circle {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: var(--tx-primary-soft);
            color: var(--tx-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 30px;
        }

        #tx-bulk-order-root .tx-bo-submit-box h2 {
            font-size: 23px;
            margin: 0 0 10px;
            font-weight: 600;
        }

        #tx-bulk-order-root .tx-bo-submit-box p {
            color: var(--tx-muted);
            line-height: 1.6;
            font-size: 14px;
        }

        #tx-bulk-order-root .tx-bo-security {
            margin: 22px 0;
            background: var(--tx-bg);
            border: 1px solid var(--tx-border);
            padding: 13px;
            border-radius: 10px;
            font-size: 12px;
            color: var(--tx-muted);
        }

        #tx-bulk-order-root .tx-bo-alert {
            display: none;
            text-align: left;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13.5px;
            margin-bottom: 20px;
        }

        #tx-bulk-order-root .tx-bo-alert.tx-bo-alert-error {
            background: #fdeceb;
            color: #9c2b2b;
            border: 1px solid #f3c8c4;
        }

        #tx-bulk-order-root .tx-bo-alert.show {
            display: block;
        }

        #tx-bulk-order-root .tx-bo-whatsapp-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            height: 50px;
            border-radius: 10px;
            background: #25d366;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            border: 0;
        }

        #tx-bulk-order-root .tx-bo-whatsapp-btn:hover {
            filter: brightness(0.96);
        }

        #tx-bulk-order-root .tx-bo-enquiry-code {
            display: inline-block;
            background: var(--tx-primary-soft);
            color: var(--tx-primary-dark);
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 13px;
            margin-bottom: 18px;
            letter-spacing: 0.02em;
        }

        /* Buttons */
        #tx-bulk-order-root .tx-bo-nav {
            display: flex;
            justify-content: space-between;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--tx-border);
        }

        #tx-bulk-order-root .tx-bo-btn {
            min-width: 130px;
            height: 48px;
            padding: 0 22px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 13.5px;
            font-weight: 700;
            font-family: inherit;
            transition: 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        #tx-bulk-order-root .tx-bo-btn-back {
            background: #fff;
            border: 1.5px solid var(--tx-border);
            color: var(--tx-ink);
        }

        #tx-bulk-order-root .tx-bo-btn-back:hover {
            border-color: var(--tx-muted);
        }

        #tx-bulk-order-root .tx-bo-btn-next,
        #tx-bulk-order-root .tx-bo-btn-submit {
            background: var(--tx-primary);
            color: #fff;
            border: 1.5px solid var(--tx-primary);
            box-shadow: 0 10px 24px -12px rgba(121, 85, 72, 0.7);
        }

        #tx-bulk-order-root .tx-bo-btn-next:hover,
        #tx-bulk-order-root .tx-bo-btn-submit:hover {
            background: var(--tx-primary-dark);
            border-color: var(--tx-primary-dark);
        }

        #tx-bulk-order-root .tx-bo-btn:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        @media (max-width: 700px) {
            #tx-bulk-order-root .tx-bo-steps {
                padding: 18px 6px;
            }

            #tx-bulk-order-root .tx-bo-step-title {
                display: none;
            }

            #tx-bulk-order-root .tx-bo-step.active .tx-bo-step-title,
            #tx-bulk-order-root .tx-bo-step.completed .tx-bo-step-title {
                display: block;
            }

            #tx-bulk-order-root .tx-bo-step-circle {
                width: 32px;
                height: 32px;
            }

            #tx-bulk-order-root .tx-bo-step:not(:last-child)::after {
                top: 15px;
                left: calc(50% + 16px);
                right: calc(-50% + 16px);
            }

            #tx-bulk-order-root .tx-bo-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            #tx-bulk-order-root .tx-bo-group.full {
                grid-column: auto;
            }

            #tx-bulk-order-root .tx-bo-product-header {
                display: none;
            }

            #tx-bulk-order-root .tx-bo-product-row {
                grid-template-columns: 1fr;
                gap: 8px;
                border: 1px solid var(--tx-border);
                border-radius: 10px;
                padding: 12px;
                position: relative;
            }

            #tx-bulk-order-root .tx-bo-remove-product {
                position: absolute;
                top: 10px;
                right: 10px;
            }

            #tx-bulk-order-root .tx-bo-preview-grid {
                grid-template-columns: 1fr;
            }

            #tx-bulk-order-root .tx-bo-nav {
                gap: 10px;
            }

            #tx-bulk-order-root .tx-bo-btn {
                flex: 1;
                min-width: 0;
            }
        }
    </style>

    <div class="tx-bo-wrap">

        <div class="tx-bo-head">
            <span class="tx-bo-eyebrow">saigreen B2B</span>
            <h1>Request a Bulk Order Quote</h1>
            <p>Tell us what you need. Our B2B team will contact you with pricing and availability.</p>
        </div>

        <div class="tx-bo-card">

            <div class="tx-bo-steps" id="tx-bo-steps">
                <div class="tx-bo-step active" data-step="1">
                    <div class="tx-bo-step-circle">1</div>
                    <div class="tx-bo-step-title">Basic Details</div>
                </div>
                <div class="tx-bo-step" data-step="2">
                    <div class="tx-bo-step-circle">2</div>
                    <div class="tx-bo-step-title">Order Details</div>
                </div>
                <div class="tx-bo-step" data-step="3">
                    <div class="tx-bo-step-circle">3</div>
                    <div class="tx-bo-step-title">Shipping</div>
                </div>
                <div class="tx-bo-step" data-step="4">
                    <div class="tx-bo-step-circle">4</div>
                    <div class="tx-bo-step-title">Preview</div>
                </div>
                <div class="tx-bo-step" data-step="5">
                    <div class="tx-bo-step-circle">5</div>
                    <div class="tx-bo-step-title">Submit</div>
                </div>
            </div>

            <form id="tx-bo-form" class="tx-bo-content" novalidate>
                @csrf

                <div class="tx-bo-alert tx-bo-alert-error" id="tx-bo-error-alert"></div>

                <!-- STEP 1 -->
                <div class="tx-bo-panel active" id="tx-bo-step-1">
                    <div class="tx-bo-section-heading">
                        <h2>Basic Details</h2>
                        <p>Tell us about yourself or your organization.</p>
                    </div>

                    <div class="tx-bo-row">
                        <div class="tx-bo-group" data-field="full_name">
                            <label>Full Name <span class="tx-bo-required">*</span></label>
                            <input type="text" name="full_name" class="tx-bo-control" placeholder="Enter your full name" maxlength="120">
                            <div class="tx-bo-field-error">Please enter your full name.</div>
                        </div>

                        <div class="tx-bo-group" data-field="company_name">
                            <label>Company / Institution Name <span class="tx-bo-required">*</span></label>
                            <input type="text" name="company_name" class="tx-bo-control" placeholder="Enter company / institution name" maxlength="191">
                            <div class="tx-bo-field-error">Please enter your company / institution name.</div>
                        </div>

                        <div class="tx-bo-group" data-field="phone">
                            <label>Mobile / WhatsApp Number <span class="tx-bo-required">*</span></label>
                            <div class="tx-bo-phone">
                                <div class="tx-bo-country-code">+91</div>
                                <input type="tel" name="phone" class="tx-bo-control" placeholder="Enter 10-digit mobile number" maxlength="15">
                            </div>
                            <div class="tx-bo-field-error">Please enter a valid mobile number.</div>
                        </div>

                        <div class="tx-bo-group" data-field="email">
                            <label>Email <span class="tx-bo-optional">(Optional)</span></label>
                            <input type="email" name="email" class="tx-bo-control" placeholder="Enter email address" maxlength="120">
                            <div class="tx-bo-field-error">Please enter a valid email address.</div>
                        </div>

                        <div class="tx-bo-group" data-field="customer_type">
                            <label>Customer Type <span class="tx-bo-required">*</span></label>
                            <select name="customer_type" class="tx-bo-control">
                                <option value="">Select customer type</option>
                                <option>Hotel</option>
                                <option>Hospital</option>
                                <option>School</option>
                                <option>College</option>
                                <option>Corporate</option>
                                <option>Wholesaler</option>
                                <option>Distributor</option>
                                <option>Other</option>
                            </select>
                            <div class="tx-bo-field-error">Please select a customer type.</div>
                        </div>

                        <div class="tx-bo-group" data-field="gstin">
                            <label>GSTIN <span class="tx-bo-optional">(Optional)</span></label>
                            <input type="text" name="gstin" class="tx-bo-control" placeholder="Enter GSTIN" maxlength="30">
                        </div>
                    </div>

                    <div class="tx-bo-nav">
                        <div></div>
                        <button type="button" class="tx-bo-btn tx-bo-btn-next" data-action="next">Continue →</button>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="tx-bo-panel" id="tx-bo-step-2">
                    <div class="tx-bo-section-heading">
                        <h2>Order Details</h2>
                        <p>Add all the products and approximate quantities you require.</p>
                    </div>

                    <div class="tx-bo-product-header">
                        <div>Product / Category</div>
                        <div>Quantity</div>
                        <div>Unit</div>
                        <div></div>
                    </div>

                    <div id="tx-bo-product-list"></div>

                    <button type="button" class="tx-bo-add-product" data-action="add-product">+ Add Another Product</button>
                    <div class="tx-bo-field-error" id="tx-bo-products-error" style="margin-top: 10px;">Please add at least one product with a valid quantity.</div>

                    <div class="tx-bo-group full" data-field="attachment" style="margin-top: 25px;">
                        <label>Upload Requirement / Product Reference <span class="tx-bo-optional">(Optional)</span></label>
                        <input type="file" name="attachment" id="tx-bo-attachment" class="tx-bo-control tx-bo-file-control" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">
                        <small class="tx-bo-hint">Choose File - Max 5 MB</small>
                        <div class="tx-bo-field-error">The file must not be larger than 5 MB.</div>
                    </div>

                    <div class="tx-bo-group full" style="margin-top: 20px;">
                        <label>Requirement / Message <span class="tx-bo-optional">(Optional)</span></label>
                        <textarea name="message" class="tx-bo-control" maxlength="5000" placeholder="Tell us about your product specifications, colour, size, quality, packing or any other requirement..."></textarea>
                    </div>

                    <div class="tx-bo-nav">
                        <button type="button" class="tx-bo-btn tx-bo-btn-back" data-action="back">← Back</button>
                        <button type="button" class="tx-bo-btn tx-bo-btn-next" data-action="next">Continue →</button>
                    </div>
                </div>

                <!-- STEP 3 -->
                <div class="tx-bo-panel" id="tx-bo-step-3">
                    <div class="tx-bo-section-heading">
                        <h2>Shipping Details</h2>
                        <p>Tell us where the bulk order needs to be delivered.</p>
                    </div>

                    <div class="tx-bo-row">
                        <div class="tx-bo-group full" data-field="address">
                            <label>Address <span class="tx-bo-required">*</span></label>
                            <textarea name="address" class="tx-bo-control" maxlength="2000" placeholder="Enter complete delivery address"></textarea>
                            <div class="tx-bo-field-error">Please enter the delivery address.</div>
                        </div>

                        <div class="tx-bo-group" data-field="city">
                            <label>City <span class="tx-bo-required">*</span></label>
                            <input type="text" name="city" class="tx-bo-control" placeholder="Enter city" maxlength="120">
                            <div class="tx-bo-field-error">Please enter the city.</div>
                        </div>

                        <div class="tx-bo-group" data-field="state">
                            <label>State <span class="tx-bo-required">*</span></label>
                            @if (!empty($states))
                                <select name="state" class="tx-bo-control">
                                    <option value="">Select state</option>
                                    @foreach ($states as $stateName)
                                        <option value="{{ $stateName }}">{{ $stateName }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" name="state" class="tx-bo-control" placeholder="Enter state" maxlength="120">
                            @endif
                            <div class="tx-bo-field-error">Please select the state.</div>
                        </div>

                        <div class="tx-bo-group" data-field="pincode">
                            <label>Pincode <span class="tx-bo-required">*</span></label>
                            <input type="text" name="pincode" class="tx-bo-control" placeholder="Enter pincode" maxlength="10" inputmode="numeric">
                            <div class="tx-bo-field-error">Please enter a valid pincode.</div>
                        </div>
                    </div>

                    <div class="tx-bo-nav">
                        <button type="button" class="tx-bo-btn tx-bo-btn-back" data-action="back">← Back</button>
                        <button type="button" class="tx-bo-btn tx-bo-btn-next" data-action="next">Continue →</button>
                    </div>
                </div>

                <!-- STEP 4 : PREVIEW -->
                <div class="tx-bo-panel" id="tx-bo-step-4">
                    <div class="tx-bo-section-heading">
                        <h2>Order Preview</h2>
                        <p>Please review your enquiry details before submitting.</p>
                    </div>

                    <div class="tx-bo-preview-section">
                        <div class="tx-bo-preview-header">
                            <h3>Customer Details</h3>
                            <button type="button" class="tx-bo-edit-btn" data-action="goto" data-step="1">Edit</button>
                        </div>
                        <div class="tx-bo-preview-body">
                            <div class="tx-bo-preview-grid">
                                <div class="tx-bo-preview-item"><small>Full Name</small><strong id="tx-bo-preview-name">-</strong></div>
                                <div class="tx-bo-preview-item"><small>Company / Institution</small><strong id="tx-bo-preview-company">-</strong></div>
                                <div class="tx-bo-preview-item"><small>Mobile / WhatsApp</small><strong id="tx-bo-preview-mobile">-</strong></div>
                                <div class="tx-bo-preview-item"><small>Email</small><strong id="tx-bo-preview-email">-</strong></div>
                                <div class="tx-bo-preview-item"><small>Customer Type</small><strong id="tx-bo-preview-customer-type">-</strong></div>
                                <div class="tx-bo-preview-item"><small>GSTIN</small><strong id="tx-bo-preview-gst">-</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="tx-bo-preview-section">
                        <div class="tx-bo-preview-header">
                            <h3>Order Details</h3>
                            <button type="button" class="tx-bo-edit-btn" data-action="goto" data-step="2">Edit</button>
                        </div>
                        <div class="tx-bo-preview-body">
                            <table class="tx-bo-preview-table">
                                <thead>
                                    <tr><th>Product</th><th>Quantity</th><th>Unit</th></tr>
                                </thead>
                                <tbody id="tx-bo-preview-products"></tbody>
                            </table>
                            <div class="tx-bo-total-row">Total Quantity:&nbsp;<span id="tx-bo-preview-total">0</span></div>
                            <div class="tx-bo-preview-item" style="margin-top:14px;"><small>Attachment</small><strong id="tx-bo-preview-attachment">-</strong></div>
                        </div>
                    </div>

                    <div class="tx-bo-preview-section">
                        <div class="tx-bo-preview-header">
                            <h3>Shipping Details</h3>
                            <button type="button" class="tx-bo-edit-btn" data-action="goto" data-step="3">Edit</button>
                        </div>
                        <div class="tx-bo-preview-body">
                            <div class="tx-bo-preview-grid">
                                <div class="tx-bo-preview-item"><small>Pincode</small><strong id="tx-bo-preview-pincode">-</strong></div>
                                <div class="tx-bo-preview-item"><small>City</small><strong id="tx-bo-preview-city">-</strong></div>
                                <div class="tx-bo-preview-item"><small>State</small><strong id="tx-bo-preview-state">-</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="tx-bo-preview-section">
                        <div class="tx-bo-preview-header">
                            <h3>Requirement / Message</h3>
                            <button type="button" class="tx-bo-edit-btn" data-action="goto" data-step="2">Edit</button>
                        </div>
                        <div class="tx-bo-preview-body">
                            <p id="tx-bo-preview-message" style="font-size:13px;color:var(--tx-muted);line-height:1.6;margin:0;">-</p>
                        </div>
                    </div>

                    <div class="tx-bo-nav">
                        <button type="button" class="tx-bo-btn tx-bo-btn-back" data-action="back">← Back</button>
                        <button type="button" class="tx-bo-btn tx-bo-btn-next" data-action="next">Continue →</button>
                    </div>
                </div>

                <!-- STEP 5 : SUBMIT / SUCCESS -->
                <div class="tx-bo-panel" id="tx-bo-step-5">
                    <div class="tx-bo-submit-box" id="tx-bo-submit-view">
                        <div class="tx-bo-icon-circle">✓</div>
                        <h2>Ready to Submit Your Enquiry?</h2>
                        <p>Your requirement will be sent to the saigreen B2B team, and you'll also get an option to send it to us directly on WhatsApp.</p>

                        <div class="tx-bo-security">🔒 Your information is safe and will only be used for processing your enquiry.</div>

                        <button type="submit" class="tx-bo-btn tx-bo-btn-submit" id="tx-bo-submit-btn" style="width:100%;">
                            <span id="tx-bo-submit-btn-text">GET BULK QUOTE →</span>
                        </button>
                    </div>

                    <div class="tx-bo-submit-box" id="tx-bo-success-view" style="display:none;">
                        <div class="tx-bo-icon-circle" style="background:#e6f4ea;color:var(--tx-success);">✓</div>
                        <h2>Enquiry Submitted Successfully!</h2>
                        <div class="tx-bo-enquiry-code" id="tx-bo-success-code">TEX-BULK-00000</div>
                        <p>Thank you! Our B2B team has received your request and will contact you shortly. You can also send these details to us instantly on WhatsApp.</p>

                        <a href="#" target="_blank" rel="noopener" class="tx-bo-whatsapp-btn" id="tx-bo-whatsapp-link">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2c-5.5 0-9.96 4.46-9.96 9.96 0 1.76.46 3.48 1.34 5L2 22l5.2-1.36a9.94 9.94 0 0 0 4.84 1.23h.01c5.5 0 9.96-4.46 9.96-9.96 0-2.66-1.03-5.16-2.9-7.04A9.9 9.9 0 0 0 12.04 2Zm0 18.19h-.01a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.09.81.82-3.01-.2-.31a8.24 8.24 0 0 1-1.26-4.4c0-4.55 3.7-8.25 8.25-8.25 2.2 0 4.27.86 5.83 2.42a8.2 8.2 0 0 1 2.41 5.83c0 4.55-3.71 8.24-8.25 8.24Zm4.52-6.16c-.25-.12-1.46-.72-1.69-.8-.23-.08-.39-.12-.56.12-.16.25-.64.8-.78.96-.14.16-.29.18-.54.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.14-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.15.16-.25.24-.41.08-.16.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.48-.4-.42-.56-.42-.14-.01-.31-.01-.47-.01a.9.9 0 0 0-.66.31c-.23.25-.86.85-.86 2.06 0 1.22.89 2.4 1.01 2.56.12.16 1.75 2.67 4.24 3.74.59.26 1.06.41 1.42.52.6.19 1.14.16 1.57.1.48-.07 1.46-.6 1.67-1.17.21-.58.21-1.07.14-1.17-.06-.11-.22-.17-.47-.29Z"/></svg>
                            Continue on WhatsApp
                        </a>

                        <div style="margin-top:16px;">
                            <button type="button" class="tx-bo-btn tx-bo-btn-back" id="tx-bo-reset-btn" style="width:100%;">Submit Another Enquiry</button>
                        </div>
                    </div>

                    <div class="tx-bo-nav" id="tx-bo-step-5-nav">
                        <button type="button" class="tx-bo-btn tx-bo-btn-back" data-action="back">← Back</button>
                        <div></div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
(function () {
    var root = document.getElementById('tx-bulk-order-root');
    if (!root) {
        return;
    }

    var form = root.querySelector('#tx-bo-form');
    var totalSteps = 5;
    var currentStep = 1;
    var productIndex = 0;
    var submitUrl = @json(route('public.bulk-order.submit'));

    var productOptions = ['Bedsheets', 'Pillow Covers', 'Towels', 'Duvets', 'Blankets', 'Curtains', 'Bath Mats', 'Kitchen Linen', 'Aprons', 'Table Cloth', 'Other'];
    var unitOptions = ['Pieces', 'Sets', 'Dozens', 'Kg'];

    function el(selector) {
        return root.querySelector(selector);
    }

    function els(selector) {
        return root.querySelectorAll(selector);
    }

    function buildOptions(values, placeholder) {
        var html = placeholder ? '<option value="">' + placeholder + '</option>' : '';
        values.forEach(function (value) {
            html += '<option>' + value + '</option>';
        });
        return html;
    }

    function addProductRow() {
        var index = productIndex++;
        var row = document.createElement('div');
        row.className = 'tx-bo-product-row';
        row.dataset.index = index;
        row.innerHTML =
            '<select class="tx-bo-control tx-bo-product-name" name="products[' + index + '][name]">' + buildOptions(productOptions, 'Select product') + '</select>' +
            '<input type="number" class="tx-bo-control tx-bo-product-quantity" name="products[' + index + '][quantity]" placeholder="Quantity" min="1">' +
            '<select class="tx-bo-control tx-bo-product-unit" name="products[' + index + '][unit]">' + buildOptions(unitOptions, '') + '</select>' +
            '<button type="button" class="tx-bo-remove-product" data-action="remove-product">&times;</button>';
        el('#tx-bo-product-list').appendChild(row);
    }

    function removeProductRow(button) {
        var rows = els('.tx-bo-product-row');
        if (rows.length <= 1) {
            return;
        }
        button.closest('.tx-bo-product-row').remove();
    }

    function pruneInvalidProductRows() {
        els('.tx-bo-product-row').forEach(function (row) {
            var name = row.querySelector('.tx-bo-product-name').value;
            var qty = parseInt(row.querySelector('.tx-bo-product-quantity').value, 10) || 0;
            if (!name || qty <= 0) {
                row.remove();
            }
        });
    }

    function clearErrors() {
        els('.tx-bo-group').forEach(function (group) {
            group.classList.remove('has-error');
        });
        el('#tx-bo-products-error').classList.remove('show');
        var alertBox = el('#tx-bo-error-alert');
        alertBox.classList.remove('show');
        alertBox.textContent = '';
    }

    function showFieldError(name) {
        var group = root.querySelector('.tx-bo-group[data-field="' + name + '"]');
        if (group) {
            group.classList.add('has-error');
        }
    }

    function showAlert(message) {
        var alertBox = el('#tx-bo-error-alert');
        alertBox.textContent = message;
        alertBox.classList.add('show');
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function validateStep(step) {
        clearErrors();
        var valid = true;

        if (step === 1) {
            ['full_name', 'company_name'].forEach(function (name) {
                var input = form.querySelector('[name="' + name + '"]');
                if (!input.value.trim()) {
                    showFieldError(name);
                    valid = false;
                }
            });

            var phone = form.querySelector('[name="phone"]').value.trim();
            if (!/^[0-9]{7,15}$/.test(phone)) {
                showFieldError('phone');
                valid = false;
            }

            var email = form.querySelector('[name="email"]').value.trim();
            if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showFieldError('email');
                valid = false;
            }

            if (!form.querySelector('[name="customer_type"]').value) {
                showFieldError('customer_type');
                valid = false;
            }
        }

        if (step === 2) {
            var hasValidProduct = false;
            els('.tx-bo-product-row').forEach(function (row) {
                var name = row.querySelector('.tx-bo-product-name').value;
                var qty = parseInt(row.querySelector('.tx-bo-product-quantity').value, 10) || 0;
                if (name && qty > 0) {
                    hasValidProduct = true;
                }
            });
            if (!hasValidProduct) {
                el('#tx-bo-products-error').classList.add('show');
                valid = false;
            }

            var attachmentInput = el('#tx-bo-attachment');
            if (attachmentInput.files && attachmentInput.files[0] && attachmentInput.files[0].size > 5 * 1024 * 1024) {
                showFieldError('attachment');
                valid = false;
            }
        }

        if (step === 3) {
            ['city', 'state'].forEach(function (name) {
                var input = form.querySelector('[name="' + name + '"]');
                if (!input.value.trim()) {
                    showFieldError(name);
                    valid = false;
                }
            });

            if (!form.querySelector('[name="address"]').value.trim()) {
                showFieldError('address');
                valid = false;
            }

            var pincode = form.querySelector('[name="pincode"]').value.trim();
            if (!/^[0-9]{4,10}$/.test(pincode)) {
                showFieldError('pincode');
                valid = false;
            }
        }

        return valid;
    }

    function goToStep(step) {
        currentStep = step;

        els('.tx-bo-panel').forEach(function (panel) {
            panel.classList.remove('active');
        });
        el('#tx-bo-step-' + step).classList.add('active');

        els('.tx-bo-step').forEach(function (item) {
            var itemStep = parseInt(item.dataset.step, 10);
            item.classList.remove('active', 'completed');
            var circle = item.querySelector('.tx-bo-step-circle');

            if (itemStep === step) {
                item.classList.add('active');
            }

            if (itemStep < step) {
                item.classList.add('completed');
                circle.innerHTML = '&check;';
            } else {
                circle.innerHTML = itemStep;
            }
        });

        if (step === 4) {
            generatePreview();
        }

        root.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function generatePreview() {
        el('#tx-bo-preview-name').textContent = form.querySelector('[name="full_name"]').value || '-';
        el('#tx-bo-preview-company').textContent = form.querySelector('[name="company_name"]').value || '-';
        el('#tx-bo-preview-mobile').textContent = '+91 ' + (form.querySelector('[name="phone"]').value || '-');
        el('#tx-bo-preview-email').textContent = form.querySelector('[name="email"]').value || '-';
        el('#tx-bo-preview-customer-type').textContent = form.querySelector('[name="customer_type"]').value || '-';
        el('#tx-bo-preview-gst').textContent = form.querySelector('[name="gstin"]').value || '-';

        el('#tx-bo-preview-pincode').textContent = form.querySelector('[name="pincode"]').value || '-';
        el('#tx-bo-preview-city').textContent = form.querySelector('[name="city"]').value || '-';
        el('#tx-bo-preview-state').textContent = form.querySelector('[name="state"]').value || '-';
        el('#tx-bo-preview-message').textContent = form.querySelector('[name="message"]').value || 'No additional message.';

        var attachmentFile = el('#tx-bo-attachment').files;
        el('#tx-bo-preview-attachment').textContent = (attachmentFile && attachmentFile[0]) ? attachmentFile[0].name : 'No file uploaded.';

        var tbody = el('#tx-bo-preview-products');
        tbody.innerHTML = '';
        var total = 0;

        els('.tx-bo-product-row').forEach(function (row) {
            var name = row.querySelector('.tx-bo-product-name').value;
            var qty = parseInt(row.querySelector('.tx-bo-product-quantity').value, 10) || 0;
            var unit = row.querySelector('.tx-bo-product-unit').value;

            if (name && qty > 0) {
                total += qty;
                var tr = document.createElement('tr');
                tr.innerHTML = '<td>' + name + '</td><td>' + qty + '</td><td>' + unit + '</td>';
                tbody.appendChild(tr);
            }
        });

        el('#tx-bo-preview-total').textContent = total.toLocaleString();
    }

    root.addEventListener('click', function (event) {
        var target = event.target.closest('[data-action]');
        if (!target) {
            return;
        }

        var action = target.dataset.action;

        if (action === 'next') {
            if (validateStep(currentStep) && currentStep < totalSteps) {
                goToStep(currentStep + 1);
            }
        } else if (action === 'back') {
            if (currentStep > 1) {
                goToStep(currentStep - 1);
            }
        } else if (action === 'goto') {
            goToStep(parseInt(target.dataset.step, 10));
        } else if (action === 'add-product') {
            addProductRow();
        } else if (action === 'remove-product') {
            removeProductRow(target);
        }
    });

    el('#tx-bo-reset-btn').addEventListener('click', function () {
        form.reset();
        els('.tx-bo-product-row').forEach(function (row, i) {
            if (i > 0) {
                row.remove();
            }
        });
        el('#tx-bo-submit-view').style.display = '';
        el('#tx-bo-success-view').style.display = 'none';
        el('#tx-bo-step-5-nav').style.display = '';
        goToStep(1);
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        if (!validateStep(1) || !validateStep(2) || !validateStep(3)) {
            showAlert('Please complete all required fields before submitting.');
            return;
        }

        pruneInvalidProductRows();

        var submitBtn = el('#tx-bo-submit-btn');
        var submitBtnText = el('#tx-bo-submit-btn-text');
        submitBtn.disabled = true;
        submitBtnText.textContent = 'Submitting...';

        var formData = new FormData(form);

        fetch(submitUrl, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
            .then(function (response) {
                return response.json().then(function (data) {
                    return { status: response.status, ok: response.ok, data: data };
                });
            })
            .then(function (result) {
                var hasError = !result.ok || (result.data && result.data.error);

                if (hasError) {
                    if (result.status === 422 && result.data.errors) {
                        var firstMessage = '';
                        Object.keys(result.data.errors).forEach(function (key) {
                            if (!firstMessage) {
                                firstMessage = result.data.errors[key][0];
                            }
                        });
                        showAlert(firstMessage || 'Please check the details you entered and try again.');
                    } else {
                        showAlert((result.data && result.data.message) || 'Something went wrong. Please try again.');
                    }
                    return;
                }

                var payload = result.data.data || {};
                el('#tx-bo-success-code').textContent = payload.code || '';
                el('#tx-bo-whatsapp-link').setAttribute('href', payload.whatsapp_url || '#');
                el('#tx-bo-submit-view').style.display = 'none';
                el('#tx-bo-success-view').style.display = '';
                el('#tx-bo-step-5-nav').style.display = 'none';

                if (payload.whatsapp_url) {
                    window.open(payload.whatsapp_url, '_blank');
                }
            })
            .catch(function () {
                showAlert('Unable to submit your enquiry right now. Please check your connection and try again.');
            })
            .finally(function () {
                submitBtn.disabled = false;
                submitBtnText.textContent = 'GET BULK QUOTE →';
            });
    });

    addProductRow();
})();
</script>
