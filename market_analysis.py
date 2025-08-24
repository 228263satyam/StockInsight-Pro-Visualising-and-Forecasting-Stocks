import streamlit as st
import pandas as pd
import yfinance as yf
import plotly.express as px
import numpy as np
from alpha_vantage.fundamentaldata import FundamentalData
from stocknews import StockNews
from datetime import datetime

# Set the title of the Streamlit app
st.title('Market Analysis')

# Sidebar inputs for ticker, start date, and end date
ticker = st.sidebar.text_input('Ticker', value='AAPL')
start_date = st.sidebar.date_input('Start Date', value=datetime(2020, 1, 1))
end_date = st.sidebar.date_input('End Date', value=datetime.today())

# Download stock data from Yahoo Finance
if ticker:
    try:
        data = yf.download(ticker, start=start_date, end=end_date)
        if not data.empty:
            # Create a line plot of the adjusted closing prices
            fig = px.line(data, x=data.index, y='Adj Close', title=f'{ticker} Price Movement')
            st.plotly_chart(fig)
        else:
            st.write("No data found for the given date range.")
    except Exception as e:
        st.write(f"An error occurred while fetching stock data: {e}")

# Create tabs for different sections
pricing_data, fundamental_data, news = st.tabs(["Pricing Data", "Fundamental Data", "Top 10 News"])

with pricing_data:
    st.header('Price Movement')
    
    if not data.empty:
        try:
            # Calculate the percentage change
            data['% Change'] = data['Adj Close'].pct_change()
            data.dropna(inplace=True)
            st.write(data)

            # Calculate annual return and standard deviation
            annual_return = data['% Change'].mean() * 252 * 100
            stdev = np.std(data['% Change']) * np.sqrt(252)

            st.write(f'Annual Return: {annual_return:.2f}%')
            st.write(f'Standard Deviation: {stdev*100:.2f}%')
            st.write(f'Sharpe Ratio: {annual_return / (stdev * 100):.2f}')
        except Exception as e:
            st.write(f"An error occurred in pricing data calculations: {e}")
    else:
        st.write("No data to display in 'Pricing Data' tab.")

with fundamental_data:
    st.subheader('Fundamental Data')
    # Replace with your Alpha Vantage API key
    key = '6T0Q1CK2QN7QD1WH'
    fd = FundamentalData(key, output_format='pandas')
    
    try:
        st.subheader('Balance Sheet')
        balance_sheet = fd.get_balance_sheet_annual(ticker)[0]
        bs = balance_sheet.T[2:]
        bs.columns = list(balance_sheet.T.iloc[0])
        st.write(bs)
        
        st.subheader('Income Statement')
        income_statement = fd.get_income_statement_annual(ticker)[0]
        is1 = income_statement.T[2:]
        is1.columns = list(income_statement.T.iloc[0])
        st.write(is1)
        
        st.subheader('Cash Flow Statement')
        cash_flow = fd.get_cash_flow_annual(ticker)[0]
        cf = cash_flow.T[2:]
        cf.columns = list(cash_flow.T.iloc[0])
        st.write(cf)
        
    except Exception as e:
        st.write(f"An error occurred while fetching fundamental data: {e}")

with news:
    st.header(f'News for {ticker}')
    sn = StockNews(ticker, save_news=False)
    
    try:
        df_news = sn.read_rss()
        for i in range(min(10, len(df_news))):
            st.subheader(f'News {i+1}')
            st.write(df_news['published'][i])
            st.write(df_news['title'][i])
            st.write(df_news['summary'][i])
            title_sentiment = df_news['sentiment_title'][i]
            st.write(f'Title Sentiment: {title_sentiment}')
            news_sentiment = df_news['sentiment_news'][i]
            st.write(f'News Sentiment: {news_sentiment}')
    except Exception as e:
        st.write(f"An error occurred while fetching news: {e}")
